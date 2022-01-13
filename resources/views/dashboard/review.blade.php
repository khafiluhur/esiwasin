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
                        <a class="nav-link active" href="#reviu_laporan_keuangan" data-toggle="tab">Reviu Laporan Keuangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviu_kegiatan_anggaran" data-toggle="tab">Reviu Kegiatan Anggaran (RKA)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviu_lakip" data-toggle="tab">Reviu LAKIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviu_rkbmn" data-toggle="tab">Reviu RKBMN</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="reviu_laporan_keuangan" role="tabpanel">
                    @if(!$pkpt_keuangan->isEmpty())
                         @if($data1)
                            @if($data1->ketua == Auth::user()->id)
                                @if($data1->status_ketua == "Setuju")
                                    @include('partial.reviu.keuangan.form_default') 
                                @else
                                    @include('partial.reviu.keuangan.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data1->status_pt == "Setuju")
                                    @include('partial.reviu.keuangan.form_default')
                                @else
                                    @if ($data1->status_ketua == "Setuju")
                                        @include('partial.reviu.keuangan.form_setuju') 
                                    @else
                                        @include('partial.reviu.keuangan.form_default')
                                    @endif
                                @endif 
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data1->status_pm == "Setuju")
                                    @include('partial.reviu.keuangan.form_default')
                                @else
                                    @if ($data1->status_pt == "Setuju")
                                        @include('partial.reviu.keuangan.form_setuju')
                                    @else
                                        @include('partial.reviu.keuangan.form_default')
                                    @endif 
                                @endif    
                            @elseif($data1->created_by == Auth::user()->id)
                                @if($data1->is_status == 1)
                                    @include('partial.reviu.keuangan.form_default') 
                                @else
                                    @include('partial.reviu.keuangan.form_field')
                                @endif
                            @else
                                @include('partial.reviu.keuangan.form_default')   
                            @endif
                        @else
                            @include('partial.reviu.keuangan.form_default') 
                        @endif 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Reviu Laporan Keuangan <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="reviu_kegiatan_anggaran" role="tabpanel">
                    @if(!$pkpt_anggaran->isEmpty())
                        @if($data2)
                            @if($data2->ketua == Auth::user()->id)
                                @if($data2->status_ketua == "Setuju")
                                    @include('partial.reviu.anggaran.form_default') 
                                @else
                                    @include('partial.reviu.anggaran.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data2->status_pt == "Setuju")
                                    @include('partial.reviu.anggaran.form_default')
                                @else
                                    @if ($data2->status_ketua == "Setuju")
                                        @include('partial.reviu.anggaran.form_setuju') 
                                    @else
                                        @include('partial.reviu.anggaran.form_default')
                                    @endif
                                @endif 
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data2->status_pm == "Setuju")
                                    @include('partial.reviu.anggaran.form_default')
                                @else
                                    @if ($data2->status_pt == "Setuju")
                                        @include('partial.reviu.anggaran.form_setuju')
                                    @else
                                        @include('partial.reviu.anggaran.form_default')
                                    @endif 
                                @endif      
                            @elseif($data2->created_by == Auth::user()->id)
                                @if($data2->is_status == 1)
                                    @include('partial.reviu.anggaran.form_default') 
                                @else
                                    @include('partial.reviu.anggaran.form_field')
                                @endif
                            @else
                              @include('partial.reviu.anggaran.form_default')   
                            @endif
                        @else
                            @include('partial.reviu.anggaran.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Reviu Kegiatan Anggaran <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="reviu_lakip" role="tabpanel">
                    @if(!$pkpt_lakip->isEmpty())
                        @if($data3)
                            @if($data3->ketua == Auth::user()->id)
                                @if($data3->status_ketua == "Setuju")
                                    @include('partial.reviu.lakip.form_default') 
                                @else
                                    @include('partial.reviu.lakip.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data3->status_pt == "Setuju")
                                    @include('partial.reviu.lakip.form_default')
                                @else
                                    @if ($data3->status_ketua == "Setuju")
                                        @include('partial.reviu.lakip.form_setuju') 
                                    @else
                                        @include('partial.reviu.lakip.form_default')
                                    @endif
                                @endif 
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data3->status_pm == "Setuju")
                                    @include('partial.reviu.lakip.form_default')
                                @else
                                    @if ($data3->status_pt == "Setuju")
                                        @include('partial.reviu.lakip.form_setuju')
                                    @else
                                        @include('partial.reviu.lakip.form_default')
                                    @endif 
                                @endif     
                            @elseif($data3->created_by == Auth::user()->id)
                                @if($data3->is_status == 1)
                                    @include('partial.reviu.lakip.form_default') 
                                @else
                                    @include('partial.reviu.lakip.form_field')
                                @endif
                            @else
                              @include('partial.reviu.lakip.form_default')   
                            @endif
                        @else
                            @include('partial.reviu.lakip.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Reviu LAKIP <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="reviu_rkbmn" role="tabpanel">
                    @if(!$pkpt_rkbmn->isEmpty())
                        @if($data4)
                            @if($data4->ketua == Auth::user()->id)
                                @if($data4->status_ketua == "Setuju")
                                    @include('partial.reviu.rkbmn.form_default') 
                                @else
                                    @include('partial.reviu.rkbmn.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data4->status_pt == "Setuju")
                                    @include('partial.reviu.rkbmn.form_default')
                                @else
                                    @if ($data4->status_ketua == "Setuju")
                                        @include('partial.reviu.rkbmn.form_setuju') 
                                    @else
                                        @include('partial.reviu.rkbmn.form_default')
                                    @endif
                                @endif 
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data4->status_pm == "Setuju")
                                    @include('partial.reviu.rkbmn.form_default')
                                @else
                                    @if ($data4->status_pt == "Setuju")
                                        @include('partial.reviu.rkbmn.form_setuju')
                                    @else
                                        @include('partial.reviu.rkbmn.form_default')
                                    @endif 
                                @endif     
                            @elseif($data4->created_by == Auth::user()->id)
                                @if($data4->is_status == 1)
                                    @include('partial.reviu.rkbmn.form_default') 
                                @else
                                    @include('partial.reviu.rkbmn.form_field')
                                @endif
                            @else
                              @include('partial.reviu.rkbmn.form_default')   
                            @endif
                        @else
                            @include('partial.reviu.rkbmn.form_default') 
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Reviu RKBMN <h3>
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
      $("#add_kertas_keuangan").click(function(){ 
          var lsthmtl = $('#upload_kertas_keuangan:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_keuangan:last');
      });
      $("#add_kertas_anggaran").click(function(){ 
          var lsthmtl = $('#upload_kertas_anggaran:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_anggaran:last');
      });
      $("#add_kertas_lakip").click(function(){ 
          var lsthmtl = $('#upload_kertas_lakip:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_lakip:last');
      });
      $("#add_kertas_rkbmn").click(function(){ 
          var lsthmtl = $('#upload_kertas_rkbmn:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_rkbmn:last');
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