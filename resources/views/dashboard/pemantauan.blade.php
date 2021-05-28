@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/flatpickr/flatpickr.min.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
            </h1>
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
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#pemantauan_bpk" data-toggle="tab">Pemantauan TL BPK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pemantauan_lha" data-toggle="tab">Pemantauan TL LHA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pemantauan_spip" data-toggle="tab">Pemantauan SPIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pemantauan_lhkasn" data-toggle="tab">Pemantauan LHKASN</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="pemantauan_bpk" role="tabpanel">
                    @if(!$pkpt_bpk->isEmpty())
                        @include('partial.pemantauan.bpk') 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pemantauan TL BPK <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="pemantauan_lha" role="tabpanel">
                    @if(!$pkpt_lha->isEmpty())
                        @include('partial.pemantauan.lha') 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pemantauan TL LHA <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="pemantauan_spip" role="tabpanel">
                    @if(!$pkpt_spip->isEmpty())
                        @include('partial.pemantauan.spip') 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pemantauan SPIP <h3>
                    @endif
                    </div>   

                    <div class="tab-pane" id="pemantauan_lhkasn" role="tabpanel">
                    @if(!$pkpt_lhkasn->isEmpty())
                        @include('partial.pemantauan.lhkasn') 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pemantauan LHKASN <h3>
                    @endif
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/additional-methods.js')}}"></script>

<script src="{{asset('/js/pages/be_forms_wizard.min.js')}}"></script>

<script src="{{asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('/js/plugins/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('/js/plugins/flatpickr/flatpickr.min.js')}}"></script>

<script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection