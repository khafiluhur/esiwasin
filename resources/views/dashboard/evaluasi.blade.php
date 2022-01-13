@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/flatpickr/flatpickr.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

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
                        <a class="nav-link active" href="#evaluasi_sakip" data-toggle="tab">Evaluasi SAKIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#evaluasi_reformasi_birokrasi" data-toggle="tab">Evaluasi RB</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#evaluasi_spip" data-toggle="tab">Maturitas SPIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#evaluasi_iacm" data-toggle="tab">Evaluasi IACM</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="evaluasi_sakip" role="tabpanel">
                    @if(!$pkpt_sakip->isEmpty())
                        @if($data1)
                            @if($data1->ketua == Auth::user()->id)
                                @if($data1->status_ketua == 2)
                                    @include('partial.evaluasi.sakip.form_default') 
                                @else
                                    @include('partial.evaluasi.sakip.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data1->status_pt == 2)
                                    @include('partial.evaluasi.sakip.form_default')
                                @else
                                    @if ($data1->status_ketua == 2)
                                        @include('partial.evaluasi.sakip.form_setuju') 
                                    @else
                                        @include('partial.evaluasi.sakip.form_default')
                                    @endif
                                @endif
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data1->status_pm == 2)
                                    @include('partial.evaluasi.sakip.form_default')
                                @else
                                    @if ($data1->status_pt == 2)
                                        @include('partial.evaluasi.sakip.form_setuju')
                                    @else
                                        @include('partial.evaluasi.sakip.form_default')
                                    @endif 
                                @endif      
                            @elseif($data1->created_by == Auth::user()->id)
                                @if($data1->is_status == 1)
                                    @include('partial.evaluasi.sakip.form_default') 
                                @else
                                    @include('partial.evaluasi.sakip.form_field')
                                @endif
                            @else
                              @include('partial.evaluasi.sakip.form_default')   
                            @endif
                        @else
                            @include('partial.evaluasi.sakip.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Evaluasi SAKIP <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="evaluasi_reformasi_birokrasi" role="tabpanel">
                    @if(!$pkpt_rb->isEmpty())
                        @if($data2)
                            @if($data2->ketua == Auth::user()->id)
                                @if($data2->status_ketua == 2)
                                    @include('partial.evaluasi.reformasi.form_default') 
                                @else
                                    @include('partial.evaluasi.reformasi.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data2->status_pt == 2)
                                    @include('partial.evaluasi.reformasi.form_default')
                                @else
                                    @if ($data2->status_ketua == 2)
                                        @include('partial.evaluasi.reformasi.form_setuju') 
                                    @else
                                        @include('partial.evaluasi.reformasi.form_default')
                                    @endif
                                @endif
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data2->status_pm == 2)
                                    @include('partial.evaluasi.reformasi.form_default')
                                @else
                                    @if ($data2->status_pt == 2)
                                        @include('partial.evaluasi.reformasi.form_setuju')
                                    @else
                                        @include('partial.evaluasi.reformasi.form_default')
                                    @endif 
                                @endif       
                            @elseif($data2->created_by == Auth::user()->id)
                                @if($data2->is_status == 1)
                                    @include('partial.evaluasi.reformasi.form_default') 
                                @else
                                    @include('partial.evaluasi.reformasi.form_field')
                                @endif
                            @else
                              @include('partial.evaluasi.reformasi.form_default')   
                            @endif
                        @else
                            @include('partial.evaluasi.reformasi.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Evaluasi Reformasi Birokrasi <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="evaluasi_spip" role="tabpanel">
                    @if(!$pkpt_spip->isEmpty())
                        @if($data3)
                            @if($data3->ketua == Auth::user()->id)
                                @if($data3->status_ketua == 2)
                                    @include('partial.evaluasi.spip.form_default') 
                                @else
                                    @include('partial.evaluasi.spip.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data3->status_pt == 2)
                                    @include('partial.evaluasi.spip.form_default')
                                @else
                                    @if ($data3->status_ketua == 2)
                                        @include('partial.evaluasi.spip.form_setuju') 
                                    @else
                                        @include('partial.evaluasi.spip.form_default')
                                    @endif
                                @endif
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data3->status_pm == 2)
                                    @include('partial.evaluasi.spip.form_default')
                                @else
                                    @if ($data3->status_pt == 2)
                                        @include('partial.evaluasi.spip.form_setuju')
                                    @else
                                        @include('partial.evaluasi.spip.form_default')
                                    @endif 
                                @endif     
                            @elseif($data3->created_by == Auth::user()->id)
                                @if($data3->is_status == 1)
                                    @include('partial.evaluasi.spip.form_default') 
                                @else
                                    @include('partial.evaluasi.spip.form_field')
                                @endif
                            @else
                              @include('partial.evaluasi.spip.form_default')   
                            @endif
                        @else
                            @include('partial.evaluasi.spip.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Evaluasi SPIP <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="evaluasi_iacm" role="tabpanel">
                    @if(!$pkpt_iacm->isEmpty())
                        @if($data4)
                            @if($data4->ketua == Auth::user()->id)
                                @if($data4->status_ketua == 2)
                                    @include('partial.evaluasi.iacm.form_default') 
                                @else
                                    @include('partial.evaluasi.iacm.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data4->status_pt == 2)
                                    @include('partial.evaluasi.iacm.form_default')
                                @else
                                    @if ($data4->status_ketua == 2)
                                        @include('partial.evaluasi.iacm.form_setuju') 
                                    @else
                                        @include('partial.evaluasi.iacm.form_default')
                                    @endif
                                @endif
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data4->status_pm == 2)
                                    @include('partial.evaluasi.iacm.form_default')
                                @else
                                    @if ($data4->id_status_pt == 2)
                                        @include('partial.evaluasi.iacm.form_setuju')
                                    @else
                                        @include('partial.evaluasi.iacm.form_default')
                                    @endif 
                                @endif     
                            @elseif($data4->created_by == Auth::user()->id)
                                @if($data4->is_status == 1)
                                    @include('partial.evaluasi.iacm.form_default') 
                                @else
                                    @include('partial.evaluasi.iacm.form_field')
                                @endif
                            @else
                              @include('partial.evaluasi.iacm.form_default')   
                            @endif
                        @else
                            @include('partial.evaluasi.iacm.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Evaluasi IACM <h3>
                    @endif
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
      $("#add_kertas_sakip").click(function(){ 
          var lsthmtl = $('#upload_kertas_sakip:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_sakip:last');
      });
      $("#add_kertas_reformasi").click(function(){ 
          var lsthmtl = $('#upload_kertas_reformasi:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_reformais:last');
      });
      $("#add_kertas_spip").click(function(){ 
          var lsthmtl = $('#upload_kertas_spip:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_spip:last');
      });
      $("#add_kertas_iacm").click(function(){ 
          var lsthmtl = $('#upload_kertas_iacm:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_iacm:last');
      });
      $("body").on("click",".btn-danger",function(){ 
          console.log("delete");
          $(this).parents(".hdtuto").remove();
      });
    });
</script>
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

<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection