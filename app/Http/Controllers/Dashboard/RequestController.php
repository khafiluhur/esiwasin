<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterChannel;
use App\Models\ForeignChannel;
use App\Mail\NewRequest;
use App\Mail\AssignDone;
use App\Mail\AssignRequest;
use App\Mail\PreviewRequest;
use App\Mail\RejectRequest;
use App\Mail\StatusAssign;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function post()
    {
        $channels = DB::table('masterchannels')
                    ->select('*')
                    ->get();
        $total_channels = $channels->count();           
        $types = DB::table('types')
                 ->select('*')
                 ->get();
                //  dd($types);
        // foreach($types as $id => $name){
            // dd($id);
        // }         
        $date = Carbon::now()->format('d-m-Y'); 
        // $products = DB::table('products')
        //             ->join('categories','products.idCategory','=','categories.idCategory')
        //             ->select('products.codeProduct as codeproduct','products.nameProduct as nameproduct','categories.idCategory as idcategory','categories.nameCategory as category')
        //             ->get();  
                    // dd($products);
        $products = DB::connection('oracle')
                    ->select('select PRD_PRD_M.prd_id as codeProduct, PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where PRD_PRD_M.use_yn = :id and PRD_PRD_CLS_C.PRD_CLS_LVL = :test order by PRD_PRD_M.PRD_ID',['id' => 'Y','test' => '1']);
        $thisPage = "newrequest"; 
        $thisHead = "newrequests";                               
        return view('pages.formrequest', compact('channels','types','products','thisPage','thisHead','date','total_channels'));
    }

    public function updateById(Request $request, $id)
    {
        $datas = DB::table('requests')
                 ->leftJoin('reject_request','requests.idRequest','=','reject_request.requestId')
                 ->leftJoin('users','reject_request.userId','=','users.id')
                 ->select('requests.*','reject_request.*','users.*')
                 ->where('requests.idRequest', '=', $id)
                 ->first();
        if($datas->rejectId != null){
            DB::table('reject_request')->where('requestId', '=', $id)->delete();
        } else {
            if ($request->has('idType') && $request['idType']!=null) {
                DB::update('update requests set idType = ? where idRequest = ?',[$request->idType,$id]);
            }
            if ($request->has('dateAiring') && $request['dateAiring']!=null) {
                DB::update('update requests set dateAiring = ? where idRequest = ?',[$request->dateAiring,$id]);
            }
            if ($request->has('codeProduct') && $request['codeProduct']!=null) {
                $nameproduct = DB::connection('oracle')
                               ->select('select prd_nm as nameproduct from PRD_PRD_M where prd_id = :test',['test' => $request->codeProduct]);
                DB::update('update requests set codeProduct = ? where idRequest = ?',[$request->codeProduct,$id]);
                DB::update('update requests set nameProduct = ? where idRequest = ?',[$nameproduct[0]->nameproduct,$id]);
            }
            if ($request->has('idvNumber') && $request['idvNumber']!=null OR $request['idvNumber']==null ) {
                DB::update('update requests set idvNumber = ? where idRequest = ?',[$request->idvNumber,$id]);
            }
            if ($request->has('price') && $request['price']!=null) {
                DB::update('update requests set price = ? where idRequest = ?',[$request->price,$id]);
            }
            if ($request->has('promotion') && $request['promotion']!=null OR $request['idvNumber']==null) {
                DB::update('update requests set promotion = ? where idRequest = ?',[$request->promotion,$id]);
            }
            if ($request->has('package') && $request['package']!=null OR $request['idvNumber']==null) {
                DB::update('update requests set package = ? where idRequest = ?',[$request->package,$id]);
            }
            if ($request->has('productProfile') && $request['productProfile']!=null) {
                $file = $request->file('productProfile');
                $name = 'mnc-product-profile'. time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/product_profile', $name);
                DB::update('update requests set productProfile = ? where idRequest = ?',[$name,$id]);
            }
            if ($request->has('other') && $request['other']!=null OR $request['idvNumber']==null) {
                DB::update('update requests set other = ? where idRequest = ?',[$request->other,$id]);
            }
            if ($request->has('tvcTersedia') && $request['tvcTersedia']!=null) {
                if($request->has('tvcTersedia') && $request['tvcTersedia']==0) {
                    DB::update('update requests set tvcTersedia = ?, link = ? where idRequest = ?',[$request->tvcTersedia,null,$id]);
                } else {
                    DB::update('update requests set tvcTersedia = ?, link = ? where idRequest = ?',[$request->tvcTersedia,$request->link,$id]);
                }  
            }
            
            if ($request->has('imagesTersedia') && $request['imagesTersedia']!=null) {
                if($request->has('imagesTersedia') && $request['imagesTersedia']==0){
                    DB::update('update requests set imagesTersedia = ?, images = ?  where idRequest = ?',[$request->imagesTersedia,null,$id]);
                } else {
                    $image = $request->file('images');
                    $nameimage = 'mnc-images'. time() . '.' . $image->getClientOriginalExtension();
                    $pathimage = $image->storeAs('uploads/images', $nameimage);
                    DB::update('update requests set imagesTersedia = ?, images = ?  where idRequest = ?',[$request->imagesTersedia,$nameimage,$id]);
                }
            }
        }
        DB::update('update requests set updated_at = ? where idRequest = ?',[Carbon::now(),$id]);
        return \App::make('redirect')->refresh()->with(['success' => 'Request Berhasil Update']);
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'idType'	        => 'required|integer',
            'dateRequest'	    => 'required|max:255|string',
            'dateAiring'	    => 'required|max:255|string',
            'codeProduct'	    => 'required|string',
            'price'	            => 'required|max:255|string',
            'productProfile'	=> "required|mimes:pdf,doc,xls,ppt|max:5000",
            'tvcTersedia'	    => 'required|boolean',
            'imagesTersedia'	=> 'required|boolean',
            'select'            => 'required',
        ]);
        // $nameproduct = DB::table('products')
        //                 ->join('categories','products.idCategory','=','categories.idCategory')
        //                 ->select('products.codeProduct as codeproduct','products.nameProduct as nameproduct','categories.idCategory as idcategory','categories.nameCategory as category')
        //                 ->get();  
        $nameproduct = DB::connection('oracle')
                    ->select('select PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where prd_id = :test',['test' => $request->codeProduct]);
        $doc = $request->file('productProfile');
        $name = 'mnc-product'.time().'.'.$doc->getClientOriginalExtension();
        $path = $doc->storeAs('uploads/product_profile', $name);

        if($request->file('images') == null){
            $this->validate($request, [
                'images' => "required|mimes:rar,zip|max:10000"
            ]);
           $nameimage = null;
        } else {
            $this->validate($request, [
                'images' => "required|mimes:rar,zip|max:10000"
            ]);
            $image = $request->file('images');
            $nameimage = 'mnc-images'.time().'.'.$image->getClientOriginalExtension();
            $pathimage = $image->storeAs('uploads/images', $nameimage);
        }
        
        $date = Carbon::now()->format('d-m-Y');

        $datas = DB::table('requests')->insert([
            'idUser'            => Auth::user()->id,
            'idType'	        => $request->idType,
            'dateRequest'	    => $date,
            'dateAiring'	    => $request->dateAiring,
            'codeProduct'       => $request->codeProduct,
            'nameProduct'       => $nameproduct[0]->nameproduct,
            'category'          => $nameproduct[0]->category,
            'idcategory'        => $nameproduct[0]->idcategory,
            'idvNumber'	        => $request->idvNumber,
            'price'	            => $request->price,
            'promotion'	        => $request->promotion,
            'package'	        => $request->packakge,
            'productProfile'	=> $name,
            'other'	            => $request->other,
            'tvcTersedia'	    => $request->tvcTersedia,
            'link'              => $request->link,
            'imagesTersedia'	=> $request->imagesTersedia,
            'images'            => $nameimage,       
            'status'            => 5,
            'preview'           => false,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $data = DB::table('requests')
                ->join('types','requests.idType','=','types.idType')
                ->join('users','requests.idUser','=','users.id')
                ->where('idUser', '=', Auth::user()->id)
                ->select('requests.*','types.nameType','users.name')
                ->orderBy('created_at', 'DESC')
                ->first();
               
        DB::table('requestpics')->insert([
            'idUser' => Auth::user()->id,
            'idRequest' => $data->idRequest,
            'idStatus' => 4
        ]);

        $channels = DB::table('masterchannels')
                    ->select('*')
                    ->get();
        
        $select = $request->select;
        $dvd = $request->dvd;
        $i = 0;
        foreach($request->select as $key => $idChannels){
            $channel = MasterChannel::findOrFail($idChannels);
            $foreignChannel = new ForeignChannel;
            $foreignChannel->select = 1;
            $foreignChannel->dvd = $dvd[$i];
            $foreignChannel->idChannels = $channel->idChannel;
            $foreignChannel->idRequest = $data->idRequest;
            $foreignChannel->save(); 
            $i++;
        }
        $user = DB::table('users')
                    ->where('id','=',Auth::user()->id)
                    ->first();
        if($user->idGroup == 19){
            $pic = DB::table('users')
                ->where('idGroup','=',2)
                ->where('pic','=',1)
                ->first(); 
        } else {       
        $pic = DB::table('users')
               ->where('idGroup','=',$user->idGroup)
               ->where('pic','=',1)
               ->get();
        }  
        $message="Registered successfully";
        
        // Mail::to($pic['email'])->send(new NewRequest($data,$pic));
        return redirect(route('request.view'))->with(['success' => 'Request Berhasil']);
    }

    public function update($id)
    {
        $channels = DB::table('masterchannels')
                    ->select('*')
                    ->get();
        $types = DB::table('types')
                 ->select('*')
                 ->get();         
        $products = DB::connection('oracle')
                    ->select('select PRD_PRD_M.prd_id as codeProduct, PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where PRD_PRD_M.use_yn = :id and PRD_PRD_CLS_C.PRD_CLS_LVL = :test order by PRD_PRD_M.PRD_ID',['id' => 'Y','test' => '1']);
        $datas = DB::table('requests')
                 ->leftJoin('reject_request','requests.idRequest','=','reject_request.requestId')
                 ->leftJoin('users','reject_request.userId','=','users.id')
                 ->select('requests.*','reject_request.*','users.*')
                 ->where('requests.idRequest', '=', $id)
                 ->first();
        $test = DB::table('masterchannels')
                ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                ->select('masterchannels.*','foreignchannels.*')
                ->where('foreignchannels.idRequest','=',$id)
                ->get();     
        $thisPage = "myrequest";
        $thisHead = "request";                               
        return view('pages.formeditrequest', compact('channels', 'types', 'products', 'datas','thisPage','thisHead','test'));
    }

    public function review($id)
    {
        $channels = DB::table('masterchannels')
            ->select('*')
            ->get();
        $types = DB::table('types')
                ->select('*')
                ->get();
        $products = DB::connection('oracle')
                ->select('select PRD_PRD_M.prd_id as codeProduct, PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where PRD_PRD_M.use_yn = :id and PRD_PRD_CLS_C.PRD_CLS_LVL = :test order by PRD_PRD_M.PRD_ID',['id' => 'Y','test' => '1']);
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->leftJoin('statusrequests as asign','asignpics.statusAsign','=','asign.idStatus')
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus','asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing','asignpics.dateEditing','asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic','asignpics.dateGraphic','asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc','asignpics.dateQc','asignpics.statusAsign as idStatus','asign.nameStatus as nameStatus')
                ->where('requests.idRequest', '=', $id)
                ->first();   
        $users = DB::table('users')
                ->where('idGroup', '=', Auth::user()->idGroup)
                ->where('pic', '=', 0)
                ->select('*')
                ->get();
        $userEditor = DB::table('users')
                    ->where('idGroup', '=', 3)
                    ->get();
        $userGraphic = DB::table('users')
                        ->where('idGroup', '=', 4)
                        ->get();        
        $userQc = DB::table('users')
                        ->where('idGroup', '=', 5)
                        ->get();
        $test = DB::table('masterchannels')
                ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                ->select('masterchannels.*','foreignchannels.*')
                ->where('foreignchannels.idRequest','=',$id)
                ->get();
        $thisPage = "requestapprove";
        $thisHead = "request"; 
        return view('pages.formreviewrequest', compact('channels', 'types', 'products', 'datas', 'users', 'userQc', 'userGraphic', 'userEditor','thisPage','thisHead','test'));                                        
    }

    public function reviewPreview($id)
    {
        $channels = DB::table('masterchannels')
                    ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                    ->select('masterchannels.*','foreignchannels.*')
                    ->where('foreignchannels.idRequest','=',$id)
                    ->get();
        $types = DB::table('types')
                ->select('*')
                ->get();
        $products = DB::table('products')
                ->select('*')
                ->get();
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->leftJoin('statusrequests as asign','asignpics.statusAsign','=','asign.idStatus')
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus','asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.dateEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic', 'asignpics.dateGraphic', 'asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc', 'asignpics.dateQc', 'asignpics.statusAsign as idStatus','asign.nameStatus as nameStatus')
                ->where('requests.idRequest', '=', $id)
                ->first();
                // dd($datas); 
        $users = DB::table('users')
                 ->where('idGroup', '=', Auth::user()->idGroup)
                 ->where('pic', '=', 0)
                 ->select('*')
                 ->get();
        $userEditor = DB::table('users')
                      ->where('idGroup', '=', 3)
                      ->get();
        $userGraphic = DB::table('users')
                        ->where('idGroup', '=', 4)
                        ->get();        
        $userQc = DB::table('users')
                        ->where('idGroup', '=', 5)
                        ->get();
        $test = DB::table('masterchannels')
                ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                ->select('masterchannels.*','foreignchannels.*')
                ->where('foreignchannels.idRequest','=',$id)
                ->get();
        $thisPage = "requestpreview";
        $thisHead = "request";                                          
        return view('pages.formpreviewrequest', compact('channels', 'types', 'products', 'datas', 'users', 'userQc', 'userGraphic', 'userEditor','thisPage','thisHead','test')); 
    }

    public function approve(Request $request, $id)
    {
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->where('requests.idRequest', '=', $id)
                ->select('requests.*','requestpics.idUser as userAsign', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus')
                ->first();
        $check = DB::table('asignpics')
                 ->where('idRequest', '=', $datas->idRequest)
                 ->first();
        if(strlen($request->note) ===  0) {
            DB::table('asignpics')->insert([
                'idRequest' => $id,
                'idPic' => Auth::user()->id,
                'idProducer' => 0,
                'picEditing' => 0,
                'picGraphic' => 0,
                'picQc' => 0,
                'statusEditing' => 0,
                'statusGraphic' => 0,
                'statusQc' => 0,
                'dateEditing' => null,
                'dateGraphic' => null,
                'dateQc' => null,
                'statusAsign' => 3,
                'updated_at' => Carbon::now()
            ]);
            DB::table('requestpics')
            ->where('idRequest', '=', $datas->idRequest)
            ->update(['idStatus' => 1]);
            $producer = DB::table('users')
                        ->where('idGroup','=',2)
                        ->select('name','email')
                        ->get();
            $pic = DB::table('users')
                   ->where('id','=',Auth::user()->id)
                   ->select('name')
                   ->first();            
            $data = DB::table('requests')
                ->join('types','requests.idType','=','types.idType')
                ->join('users','requests.idUser','=','users.id')
                ->select('requests.*','types.nameType','users.name')
                ->where('idRequest','=',$id)
                ->first(); 
            // foreach($producer as $key => $producers) {                      
            //     Mail::to($producers->email)->send(new ApproveRequest($data,$producers,$pic));
            // }
        } else {
            DB::table('reject_request')->insert([
                'requestId' => $id,
                'userId' => Auth::user()->id,
                'note' => $request->note,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $user = DB::table('users')
                    ->where('id','=',$data->idUser)
                    ->select('name','email')
                    ->first();
            $pic = DB::table('users')
                   ->where('id','=',Auth::user()->id)
                   ->select('name')
                   ->first();            
            $data = DB::table('requests')
                ->join('types','requests.idType','=','types.idType')
                ->join('users','requests.idUser','=','users.id')
                ->select('requests.*','types.nameType','users.name','users.email')
                ->where('idRequest','=',$id)
                ->first();                       
            // Mail::to($user->email)->send(new RejectRequest($data,$user,$pic));
        }        
               
        return redirect(route('reqeustapprove.view'))->with(['success' => 'Request Berhasil Approve']);
    }

    public function delete($id)
    {
        DB::table('requests')->where('idRequest', '=', $id)->delete();
        DB::table('requestpics')->where('idRequest', '=', $id)->delete();
        DB::table('asignpics')->where('idRequest', '=', $id)->delete();
        DB::table('foreignchannels')->where('idRequest','=',$id)->delete();
        return redirect(route('myrequest.view'))->with(['warning' => 'Request Berhasil di hapus']);
    }

    public function myRequest()
    {
        $id = Auth::user()->id;
        $datas = DB::table('requests')
                 ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                 ->leftJoin('users', 'asignpics.picGraphic', '=', 'users.id')
                 ->leftJoin('users as editing', 'asignpics.picEditing', '=', 'editing.id')
                 ->leftJoin('users as qc', 'asignpics.picQc', '=', 'qc.id')
                 ->leftJoin('statusrequests as statusPreview', 'requests.preview','=','statusPreview.idStatus')
                 ->leftJoin('statusrequests', 'requests.status', '=', 'statusrequests.idStatus')
                 ->leftJoin('statusrequests as graphicStatus', 'asignpics.statusGraphic', '=', 'graphicStatus.idStatus')
                 ->leftJoin('statusrequests as editingStatus', 'asignpics.statusEditing', '=', 'editingStatus.idStatus')
                 ->leftJoin('statusrequests as qcStatus', 'asignpics.statusQc', '=', 'qcStatus.idStatus')
                 ->leftJoin('reject_request','requests.idRequest','=','reject_request.requestId')
                 ->select('requests.*', 'users.name as picGraphic', 'asignpics.statusGraphic', 'graphicStatus.nameStatus as nameGraphic', 'asignpics.dateGraphic','editing.name as picEditing', 'asignpics.statusEditing', 'editingStatus.nameStatus as nameEditing','asignpics.dateEditing','qc.name as picQc', 'asignpics.statusQc', 'qcStatus.nameStatus as nameQc','asignpics.dateQc','statusrequests.nameStatus as idStatus','statusPreview.nameStatus as PreviewStatus','reject_request.*')
                 ->where('requests.idUser', '=', $id)
                 ->orderByRaw('requests.created_at DESC')
                 ->get();
        $thisPage = "myrequest";
        $thisHead = "request";         
        return view('pages.request.datatablemyrequest', compact('datas','thisPage','thisHead'));         
    }

    public function requestProgress()
    {
        $datas = DB::table('requests')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('users', 'asignpics.picGraphic', '=', 'users.id')
                ->leftJoin('users as editing', 'asignpics.picEditing', '=', 'editing.id')
                ->leftJoin('users as qc', 'asignpics.picQc', '=', 'qc.id')
                ->leftJoin('statusrequests', 'requests.status', '=', 'statusrequests.idStatus')
                ->leftJoin('statusrequests as graphicStatus', 'asignpics.statusGraphic', '=', 'graphicStatus.idStatus')
                ->leftJoin('statusrequests as editingStatus', 'asignpics.statusEditing', '=', 'editingStatus.idStatus')
                ->leftJoin('statusrequests as qcStatus', 'asignpics.statusQc', '=', 'qcStatus.idStatus')
                ->select('requests.*', 'users.name as picGraphic', 'asignpics.statusGraphic', 'graphicStatus.nameStatus as nameGraphic', 'asignpics.dateGraphic', 'asignpics.picGraphic as idPicGraphic', 'editing.name as picEditing', 'asignpics.statusEditing', 'editingStatus.nameStatus as nameEditing', 'asignpics.dateEditing', 'asignpics.picEditing as idPicEditing', 'qc.name as picQc', 'asignpics.statusQc', 'qcStatus.nameStatus as nameQc', 'asignpics.dateQc', 'asignpics.picQc as idPicQc', 'statusrequests.nameStatus as idStatus')
                ->where('requests.status', '=', 4)
                ->orWhere('requests.status', '=', 5)
                ->get();
        $thisPage = "requestnewonprogress"; 
        $thisHead = "request";       
        return view('pages.request.datatablerequestprogress', compact('datas','thisPage','thisHead'));        
    }

    public function requestDone()
    {
        $datas = DB::table('requests')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('users', 'asignpics.picGraphic', '=', 'users.id')
                ->leftJoin('users as editing', 'asignpics.picEditing', '=', 'editing.id')
                ->leftJoin('users as qc', 'asignpics.picQc', '=', 'qc.id')
                ->leftJoin('statusrequests as statusPreview', 'requests.preview','=','statusPreview.idStatus')
                ->leftJoin('statusrequests', 'requests.status', '=', 'statusrequests.idStatus')
                ->leftJoin('statusrequests as graphicStatus', 'asignpics.statusGraphic', '=', 'graphicStatus.idStatus')
                ->leftJoin('statusrequests as editingStatus', 'asignpics.statusEditing', '=', 'editingStatus.idStatus')
                ->leftJoin('statusrequests as qcStatus', 'asignpics.statusQc', '=', 'qcStatus.idStatus')
                ->select('requests.*', 'users.name as picGraphic', 'asignpics.statusGraphic', 'graphicStatus.nameStatus as nameGraphic', 'editing.name as picEditing', 'asignpics.statusEditing', 'editingStatus.nameStatus as nameEditing', 'qc.name as picQc', 'asignpics.statusQc', 'qcStatus.nameStatus as nameQc', 'statusrequests.nameStatus as idStatus','statusPreview.nameStatus as PreviewStatus')
                ->where('requests.status', '=', 2)
                ->get();
        $thisPage = "requestdone";
        $thisHead = "request";
        return view('pages.request.datatablerequestdone', compact('datas','thisPage','thisHead'));        
    }

    public function requestApprovel()
    {
        $datas = DB::table('requests')
                ->leftJoin('users','requests.idUser','=','users.id')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->select('requests.*','users.*','requestpics.idRequest','statusrequests.idStatus','statusrequests.nameStatus')
                ->where('users.idGroup','=',Auth::user()->idGroup)
                ->get();
        $thisPage = "requestapprove";
        $thisHead = "request";
        return view('pages.request.datatablerequestapprovel', compact('datas','thisPage','thisHead'));         
    }

    public function requestPreview()
    {
        $datas = DB::table('requests')
                ->leftJoin('users','requests.idUser','=','users.id')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('statusrequests as statusPreview', 'requests.preview', '=', 'statusPreview.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->select('requests.*','users.*','requestpics.idRequest','statusrequests.idStatus','statusrequests.nameStatus','asignpics.*','statusPreview.nameStatus as PreviewStatus')
                ->where('users.idGroup','=',Auth::user()->idGroup)
                ->where('statusGraphic','=',2)
                ->where('statusEditing','=',2)
                ->where('statusQc','=',2)
                ->get();
        $thisPage = "requestpreview";
        $thisHead = "request";
        return view('pages.request.datatablerequestpreview', compact('datas','thisPage','thisHead'));         
    }

    public function requestAssign()
    {
        $auth = Auth::user()->id;
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus', 'asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic', 'asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc')
                ->where('asignpics.picEditing', '=', Auth::user()->id)
                ->orWhere('asignpics.picGraphic', '=', Auth::user()->id)
                ->orWhere('asignpics.picQc', '=', Auth::user()->id)
                ->get();
        $thisPage = "requestassign";   
        $thisHead = "request";     
        return view('pages.request.datatablerequestasign', compact('datas','thisPage','thisHead'));  
    }

    public function viewRequestAssign($id)
    {
        $test =  DB::table('masterchannels')
                ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                ->select('masterchannels.*','foreignchannels.*')
                ->where('foreignchannels.idRequest','=',$id)
                ->get();
        $types = DB::table('types')
                ->select('*')
                ->get();
        $products = DB::connection('oracle')
                ->select('select PRD_PRD_M.prd_id as codeProduct, PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where PRD_PRD_M.use_yn = :id and PRD_PRD_CLS_C.PRD_CLS_LVL = :test order by PRD_PRD_M.PRD_ID',['id' => 'Y','test' => '1']);
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus', 'asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.dateEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic','asignpics.dateGraphic','asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc','asignpics.dateQc')
                ->where('requests.idRequest', '=', $id)
                ->where('asignpics.picEditing', '=', Auth::user()->id)
                ->orWhere('asignpics.picGraphic', '=', Auth::user()->id)
                ->orWhere('asignpics.picQc', '=', Auth::user()->id)
                ->first();   
                // dd($datas); 
                // $test = Auth::user()->idGroup;
        // dd($test)
        $users = DB::table('users')
                 ->where('idGroup', '=', Auth::user()->idGroup)
                 ->where('pic', '=', 0)
                 ->select('*')
                 ->get();
                //  dd($users);
        $userEditor = DB::table('users')
                      ->where('idGroup', '=', 3)
                      ->get();
        $userGraphic = DB::table('users')
                       ->where('idGroup', '=', 4)
                       ->get();        
        $userQc = DB::table('users')
                  ->where('idGroup', '=', 5)
                  ->get(); 
        $thisPage = "requestassign";   
        $thisHead = "request";  
        return view('pages.formreviewrequestasign', compact('types', 'products', 'datas', 'users', 'userQc', 'userGraphic', 'userEditor','thisPage','thisHead','test'));
    }

    public function assignDone(Request $request, $id)
    {   
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->select('requests.*', 'requestpics.idRequest', 'asignpics.idAsignpic', 'requestpics.idStatus', 'statusrequests.nameStatus', 'asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic', 'asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc')
                ->where('asignpics.picEditing', '=', Auth::user()->id)
                ->orWhere('asignpics.picGraphic', '=', Auth::user()->id)
                ->orWhere('asignpics.picQc', '=', Auth::user()->id)
                ->first();
        // dd($datas);
        if(Auth::user()->id === $datas->idEditor){
            DB::table('asignpics')->where('idAsignpic','=',$datas->idAsignpic)->update(['statusEditing' => 2,'dateEditing' => Carbon::now()->format('d-m-Y')]);
            DB::table('requests')->where('idRequest','=',$datas->idRequest)->update(['status' => 4]);
            $user = DB::table('users')
                    ->where('id','=',$datas->idUser)
                    ->first();
            if($user->idGroup == 19){
                $pic = DB::table('users')
                    ->where('idGroup','=',2)
                    ->where('pic','=',1)
                    ->first(); 
            } else {       
            $pic = DB::table('users')
                   ->where('idGroup','=',$user->idGroup)
                   ->where('pic','=',1)
                   ->first();
            }
            // Mail::to($users->email)->send(new AssignDone($datas,$users,$pic));
            // Mail::to($pic->email)->send(new AssignDone($datas,$users,$pic));                      
        } elseif(Auth::user()->id === $datas->idGraphic){
            DB::table('asignpics')->where('idAsignpic', '=', $datas->idAsignpic)->update(['statusGraphic' => 2,'dateGraphic' => Carbon::now()->format('d-m-Y') ]);
            DB::table('requests')->where('idRequest','=',$datas->idRequest)->update(['status' => 4]);
            $user = DB::table('users')
                    ->where('id','=',$datas->idUser)
                    ->first();
            // dd($user);        
            if($user->idGroup == 19){
                $pic = DB::table('users')
                    ->where('idGroup','=',2)
                    ->where('pic','=',1)
                    ->first(); 
            } else {       
            $pic = DB::table('users')
                   ->where('idGroup','=',$user->idGroup)
                   ->where('pic','=',1)
                   ->first();
            }
            // Mail::to($users->email)->send(new AssignDone($datas,$users,$pic));
            // Mail::to($pic->email)->send(new AssignDone($datas,$users,$pic));  
        } elseif(Auth::user()->id == $datas->idQc){
            $this->validate($request, [
                'idvNumber'	        => 'required|string',
            ]);
            DB::table('requests')->where('idRequest','=',$datas->idRequest)->update(['status' => 4,'idvNumber' => $request->idvNumber,]);
            DB::table('asignpics')->where('idAsignpic', '=', $datas->idAsignpic)->update(['statusQc' => 2,'dateQc' => Carbon::now()->format('d-m-Y')]); 
            $user = DB::table('users')
                    ->where('id','=',$datas->idUser)
                    ->first();
            if($user->idGroup == 19){
                $pic = DB::table('users')
                    ->where('idGroup','=',2)
                    ->where('pic','=',1)
                    ->first(); 
            } else {       
            $pic = DB::table('users')
                   ->where('idGroup','=',$user->idGroup)
                   ->where('pic','=',1)
                   ->first();
            }
            // Mail::to($users->email)->send(new AssignDone($datas,$users,$pic));
            // Mail::to($pic->email)->send(new AssignDone($datas,$users,$pic));  
        }       
        return redirect(route('requestassign.view'))->with(['success' => 'Request Berhasil Asign']);
    }

    public function statusAsign(){
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->leftJoin('statusrequests as asign','asignpics.statusAsign','=','asign.idStatus')
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus','asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic', 'asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc','asignpics.statusAsign as idStatus','asign.nameStatus as nameStatus')
                ->where('requestpics.idStatus','=', 1)
                ->get();   
        $thisPage = "statusassign";
        $thisHead = "request";
        return view('pages.request.datatablestatusasign', compact('datas','thisPage','thisHead')); 
    }
    public function reviewAsign($id)
    {
        $channels = DB::table('masterchannels')
                ->select('*')
                ->get();
        $types = DB::table('types')
                ->select('*')
                ->get();
        $products = DB::connection('oracle')
                ->select('select PRD_PRD_M.prd_id as codeProduct, PRD_PRD_M.prd_nm as nameProduct, PRD_PRD_CLS_C.PRD_LCLS_ID as idcategory, PRD_PRD_CLS_C.PRD_CLS_NM as category from PRD_PRD_M join PRD_PRD_CLS_C on PRD_PRD_M.PRD_LCLS_ID = PRD_PRD_CLS_C.PRD_LCLS_ID where PRD_PRD_M.use_yn = :id and PRD_PRD_CLS_C.PRD_CLS_LVL = :test order by PRD_PRD_M.PRD_ID',['id' => 'Y','test' => '1']);
        $datas = DB::table('requests')
                ->where('requests.idRequest', '=', $id)
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->leftJoin('asignpics', 'requests.idRequest', '=', 'asignpics.idRequest')
                ->leftJoin('statusrequests as editing', 'asignpics.statusEditing', '=', 'editing.idStatus' )
                ->leftJoin('statusrequests as graphic', 'asignpics.statusGraphic', '=', 'graphic.idStatus' )
                ->leftJoin('statusrequests as qc', 'asignpics.statusQc', '=', 'qc.idStatus' )
                ->leftJoin('statusrequests as asign','asignpics.statusAsign','=','asign.idStatus')
                ->select('requests.*', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus','asignpics.picEditing as idEditor', 'asignpics.statusEditing', 'editing.nameStatus as nameStatusEditing', 'asignpics.dateEditing', 'asignpics.picGraphic as idGraphic', 'asignpics.statusGraphic', 'graphic.nameStatus as nameStatusGraphic', 'asignpics.dateGraphic', 'asignpics.picQc as idQc', 'asignpics.statusQc', 'qc.nameStatus as nameStatusQc', 'asignpics.dateQc', 'asignpics.statusAsign as idStatus','asign.nameStatus as nameStatus')
                ->first();    
        $users = DB::table('users')
                 ->where('idGroup', '=', Auth::user()->idGroup)
                 ->where('pic', '=', 0)
                 ->select('*')
                 ->get();
        $userEditor = DB::table('users')
                      ->where('idGroup', '=', 3)
                      ->get();
        $userGraphic = DB::table('users')
                        ->where('idGroup', '=', 4)
                        ->get();        
        $userQc = DB::table('users')
                        ->where('idGroup', '=', 5)
                        ->get(); 
        $test = DB::table('masterchannels')
                ->join('foreignchannels','masterchannels.idChannel','=','foreignchannels.idChannels')
                ->select('masterchannels.*','foreignchannels.*')
                ->where('foreignchannels.idRequest','=',$id)
                ->get();
        $thisPage = "statusassign";
        $thisHead = "request";                                     
        return view('pages.formreviewrequestasign', compact('channels', 'types', 'products', 'datas', 'users', 'userQc', 'userGraphic', 'userEditor','thisPage','thisHead','test')); 
    }

    public function assignrequest(Request $request, $id)
    {
        $datas = DB::table('requests')
                ->leftJoin('requestpics', 'requests.idRequest', '=', 'requestpics.idRequest')
                ->leftJoin('statusrequests', 'requestpics.idStatus', '=', 'statusrequests.idStatus')
                ->where('requests.idRequest', '=', $id)
                ->select('requests.*','requestpics.idUser as userAsign', 'requestpics.idRequest', 'requestpics.idStatus', 'statusrequests.nameStatus')
                ->first();
        // dd($datas);
        DB::table('asignpics')->where('idRequest','=',$datas->idRequest)->update([
            'idRequest' => $id,
            'idProducer' => Auth::user()->id,
            'picEditing' => $request->picEditing,
            'dateEditing' => null,
            'picGraphic' => $request->picGraphic,
            'dateGraphic' => null,
            'picQc' => $request->picQc,
            'dateQc' => null,
            'statusEditing' => 3,
            'statusGraphic' => 3,
            'statusQc' => 3,
            'statusAsign' => 1,
            'updated_at' => Carbon::now()
        ]);       
        DB::table('requestpics')
        ->where('idRequest', '=', $datas->idRequest)
        ->update(['idStatus' => 1]);
        $user = DB::table('users')
                ->where('id','=',$request->picEditing)
                ->orWhere('id','=',$request->picGraphic)
                ->orWhere('id','=',$request->picQc)
                ->select('name','email')
                ->get();
        $pic = DB::table('users')
                ->where('id','=',Auth::user()->id)
                ->select('name','email')
                ->first();
        // foreach($user as $key => $users) {                      
            // Mail::to($users->email)->send(new AssignRequest($data,$users,$pic));
        // }
        $userRequest = DB::table('users')
                        ->where('id','=',$datas->idUser)
                        ->select('name','email','idGroup')
                        ->first();
        if($userRequest->idGroup == 19) {
            $userPic = DB::table('users')
                    ->where('idGroup','=',2)
                    ->where('pic','=',1)
                    ->first();
        } else {
            $userPic = DB::table('users')
                    ->where('idGroup','=',$userRequest)
                    ->where('pic','=',1)
                    ->first();
        }               
        // Mail::to($userRequest->email)->send(new StatusAssign($data,$userRequest));
        return redirect(route('requestasign.view'))->with(['success' => 'Request Berhasil Asign']);
    }

    public function previewDone(Request $request, $id)
    {
        DB::table('requests')->where('idRequest','=',$id)->update([
            'preview' => 2,
            'status' => 2
        ]);
        $data = DB::table('requests')
                ->where('idRequest','=',$id)
                ->first();
        $user = DB::table('users')
                ->where('id','=',$data->idUser)
                ->first();
        $pic = DB::table('users')
               ->where('id','=',Auth::user()->id)
               ->first();                
        // Mail::to($user->email)->send(new PreviewRequest($data,$user,$pic));
        return redirect(route('reqeustpreview.view'));
    }

    public function rejectRequest(Request $request, $id)
    {
        DB::table('reject_request')->insert([
            'requestId' => $id,
            'userId' => Auth::user()->id,
            'note' => $request->note
        ]);
    }
}