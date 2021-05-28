@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
            </h1>
        </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="audit_keuangan" role="tabpanel">
                        <form action="{{ route('notulensi.download', ['id' => $audit->kode ]) }}" method="GET" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <h3 style="text-align: center">{{ $title }}</h3>

                        <div class="col-12">
                            <div class="col-6 float-left">
                                <div class="form-group">
                                    <label>Nomor undangan rapat</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="nomor_undangan" name="nomor" placeholder="Nomor Undangan Rapat" value="{{ $audit->nomor }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Hari</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="hari" name="hari" placeholder="Hari" value="{{ $audit->hari }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="tanggal" name="tanggal" placeholder="Tanggal" value="{{ $audit->tanggal }}" disabled>
                                    <input class="form-control" type="hidden" id="kode" name="kode" value="{{rand()}}">
                                </div>   
                                <div class="form-group">
                                    <label>Pukul</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="pukul" name="pukul" placeholder="Pukul" value="{{ $audit->pukul }}" disabled>
                                </div>   
                                <div class="form-group">
                                    <label>Tempat</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat" value="{{ $audit->tempat }}" disabled> 
                                </div>   
                            </div>
                            <div class="col-6 float-right">
                                <div class="form-group">
                                    <label>Pimpinan Rapat</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" id="pimpinan" name="pimpinan" placeholder="Pimpinan" value="{{ $audit->pimpinan }}" disabled>
                                </div>  
                                <div class="form-group">
                                    <label for="nomor_st">Peserta Reapat</label><span class="text-danger">*</span>
                                    @foreach($anggota as $u)
                                    <input class="form-control" type="text" id="peserta" name="peserta" placeholder="Peserta" value="{{ $u->users }}" disabled>
                                    @endforeach
                                </div>  
                            </div>
                        </div>

                        <div class="content">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="example-textarea-input">Topik Bahasan</label><span class="text-danger">*</span>
                                </div>
                                <div class="input-group">
                                    <textarea class="form-control" id="catatan_notulen" name="catatan" rows="4" placeholder="Topik Bahasan" disabled>{{ $audit->catatan }}</textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="example-textarea-input">Keputusan</label><span class="text-danger">*</span>
                                    <textarea class="form-control" placeholder="Input Lampiran" id="lampiran" name="lampiran" rows="4" disabled>{{ $audit->lampiran }}</textarea>
                                </div> 
                                <div class="form-group mt-3">
                                    <label for="example-textarea-input">Kesimpulan</label><span class="text-danger">*</span>
                                    <textarea class="form-control" placeholder="Input Kesimpulan" id="kesimpualan" name="kesimpualan" rows="4" disabled>{{ $audit->kesimpualan }}</textarea>
                                </div> 
                            </div>
                        </div>  

                        <div class="block-header block-header-default">
                            <h3 class="block-title"></h3>
                            <div class="block-options">
                                <button type="submit" class="btn btn-sm btn-primary" name="unduh" value="unduh">
                                        Unduh
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function(){
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);
        });
        $("body").on("click",".btn-danger",function(){$(this).parents(".hdtuto control-group lst").remove();
        });
    });
</script>
<script src="{{asset('/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/additional-methods.js')}}"></script>

<script src="{{asset('/js/pages/be_forms_wizard.min.js')}}"></script>

<script src="{{asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['datepicker', 'rangeslider']); });</script>
@endsection