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
                        <form action="{{ route('audit.download', ['id' => $audit->kode ]) }}" method="GET">
                            {{ csrf_field() }}
                            <h3 style="text-align: center">{{$title}}</h3>

                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label>Pengendali Mutu</label>
                                        <input class="form-control" type="text" id="user_pm" name="user_pm" value="{{$audit->users_pm}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengendali Teknis</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->users_pt}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua Tim</label>
                                        <input class="form-control" type="text" id="user_ketua" name="user_ketua" value="{{$audit->users_ketua}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Anggota Tim</label>
                                        @foreach($anggota as $u)
                                        <input class="form-control" type="text" id="anggota" name="anggota" value="{{$u->nama}}" disabled>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="form-group">
                                        <label for="tanggal_audit">Tanggal Audit</label>
                                        <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$audit->tanggal_audit_from}}" disabled>
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$audit->tanggal_audit_to}}" disabled>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">Nomor ST</label>
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$audit->nomor_st}}" disabled>
                                        <input class="form-control" type="hidden" id="id" name="id" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Laporan Hasil Audit</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Judul
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="temuan_judul" name="temuan_judul" value="{{$audit->temuan_judul}}" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Kondisi
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="temuan_kondisi" name="temuan_kondisi" value="{{$audit->temuan_kondisi}}" disabled>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Kriteria
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="temuan_kriteria" name="temuan_kriteria" value="{{$audit->temuan_kriteria}}" disabled>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Sebab
                                            </span>
                                        </div> 
                                        <textarea class="form-control" id="temuan_sebab" name="temuan_sebab" rows="4" value="" disabled>{{$audit->temuan_sebab}}</textarea>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Akibat
                                            </span>
                                        </div> 
                                        <textarea class="form-control" id="temuan_akibat" name="temuan_akibat" rows="4" disabled>{{$audit->temuan_akibat}}</textarea>
                                    </div>
                                </div>
                            </div>    

                            <div class="block">
                                <div class="block-header">
                                    <div class="col-12">
                                        <h3 class="block-title">Supervisi</h3>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            Stage
                                                        </th>
                                                        <th style="width: 10%;">Status</th>
                                                        <th style="width: 10%;">Tanggal</th>
                                                        <th style="width: 10%;">Jam</th>
                                                        <th class="text-center">Komentar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_pembuat }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pembuat }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pembuat }}</td>
                                                        <td>{{ $audit->jam_pembuat }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pembuat }}</td>
                                                    </tr>
                                                    @if($audit->komentar_ketua)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_ketua }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_ketua }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_ketua }}</td>
                                                        <td>{{ $audit->jam_ketua }}</td>
                                                        <td class="text-center">{{ $audit->komentar_ketua }}</td>
                                                    </tr>
                                                    @endif
                                                    @if($audit->komentar_pt)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_pt }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pt }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pt }}</td>
                                                        <td>{{ $audit->jam_pt }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pt }}</td>
                                                    </tr>
                                                    @endif
                                                        @if($audit->komentar_pm)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_pm }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pm }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pm }}</td>
                                                        <td>{{ $audit->jam_pm }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pm }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
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