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
                        <form action="{{ route('pemantauan.download', ['id' => $audit->kode ]) }}" method="GET">
                            {{ csrf_field() }}
                            <h3 style="text-align: center">{{$title}}</h3>

                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label>Pembuat</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->createdBy}}" disabled>
                                    </div>
                                    @if($audit->jenis == 4)
                                    <div class="form-group">
                                        <label>Pangkat</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->pangkat}}" disabled>
                                    </div>
                                    @else
                                    @endif
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" type="text" id="user_pm" name="user_pm" value="{{$audit->tanggal}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->tahun}}" disabled>
                                    </div>
                                    @if($audit->jenis == 4)
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->golongan}}" disabled>
                                    </div>
                                    @else
                                    @endif
                                    <div class="form-group">
                                        <label for="nomor_st">Status</label>
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$audit->status}}" disabled>
                                        <input class="form-control" type="hidden" id="id" name="id" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Laporan Hasil Pemantauan</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                Keterangan
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="temuan_judul" name="temuan_judul" value="{{$audit->keterangan}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="block-header block-header-default">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <!-- <button type="save" class="btn btn-sm btn-secondary" name="simpan" value="simpan">
                                        Simpan
                                    </button> -->
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