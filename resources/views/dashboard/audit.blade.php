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
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#audit_keuangan" data-toggle="tab">Audit Keuangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#audit_kinerja" data-toggle="tab">Audit Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#audit_tujuan_tertentu" data-toggle="tab">Audit Tujuan Tertentu</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="audit_keuangan" role="tabpanel">
                    @if(!$pkpt_keuangan->isEmpty())
                        @if($data1 != null)
                            @if($data1->ketua == Auth::user()->id)
                                @if($data1->id_status_ketua == 2)
                                    @include('partial.audit.keuangan.form_default') 
                                @else
                                    @include('partial.audit.keuangan.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data1->id_status_pt == 2)
                                    @include('partial.audit.keuangan.form_default')
                                @else
                                    @if ($data1->id_status_ketua == 2)
                                        @include('partial.audit.keuangan.form_setuju') 
                                    @else
                                        @include('partial.audit.keuangan.form_default')
                                    @endif
                                @endif
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data1->status_pm == 2)
                                    @include('partial.audit.keuangan.form_default')
                                @else
                                    @if ($data1->id_status_pt == 2)
                                        @include('partial.audit.keuangan.form_setuju')
                                    @else
                                        @include('partial.audit.keuangan.form_default')
                                    @endif 
                                @endif      
                            @elseif($data1->created_by == Auth::user()->id)
                                @if($data1->is_status == 1)
                                    @include('partial.audit.keuangan.form_default') 
                                @else
                                    @include('partial.audit.keuangan.form_field')
                                @endif
                            @else
                                @include('partial.audit.keuangan.form_default')   
                            @endif
                        @else
                            @include('partial.audit.keuangan.form_default') 
                        @endif  
                    @else
                        <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Audit Keuangan <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="audit_kinerja" role="tabpanel">
                    @if(!$pkpt_kinerja->isEmpty())
                        @if($data2)
                            @if($data2->ketua == Auth::user()->id)
                                @if($data2->id_status_ketua == 2)
                                    @include('partial.audit.kinerja.form_default') 
                                @else
                                    @include('partial.audit.kinerja.form_setuju')
                                @endif
                            @elseif(Auth::user()->level == 3 && Auth::user()->is_active == 1)
                                @if($data2->id_status_ketua == 2)
                                    @include('partial.audit.kinerja.form_default')
                                @else
                                    @if ($data2->id_status_ketua == 2)
                                        @include('partial.audit.kinerja.form_setuju')
                                    @else
                                        @include('partial.audit.kinerja.form_default')
                                    @endif
                                @endif 
                            @elseif(Auth::user()->level == 4 && Auth::user()->is_active == 1)
                                @if($data2->id_status_pt == 2)
                                    @include('partial.audit.kinerja.form_default')
                                @else
                                    @if ($data2->id_status_ketua == 2)
                                        @include('partial.audit.kinerja.form_setuju')
                                    @else
                                        @include('partial.audit.kinerja.form_default')
                                    @endif
                                @endif      
                            @elseif($data2->created_by == Auth::user()->id)
                                @if($data2->is_status == 1)
                                    @include('partial.audit.kinerja.form_default') 
                                @else
                                    @include('partial.audit.kinerja.form_field')
                                @endif
                            @else
                                @include('partial.audit.kinerja.form_default')   
                            @endif
                        @else
                            @include('partial.audit.kinerja.form_default') 
                        @endif
                    @else
                        <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Audit Kinerja<h3>
                    @endif 
                    </div>

                    <div class="tab-pane" id="audit_tujuan_tertentu" role="tabpanel">
                    @if(!$pkpt_tujuan->isEmpty())
                        @if($data3)
                            @if($data3->ketua == Auth::user()->id)
                                @if($data3->id_status_ketua == 2)
                                    @include('partial.audit.tujuan_tertentu.form_default') 
                                @else
                                    @include('partial.audit.tujuan_tertentu.form_setuju')
                                @endif
                            @elseif($data3->id_pt == Auth::user()->id)
                                @if($data3->id_status_ketua == 2)
                                    @include('partial.audit.tujuan_tertentu.form_default')
                                @else
                                    @if ($data3->id_status_ketua == 2)
                                        @include('partial.audit.tujuan_tertentu.form_setuju')
                                    @else
                                        @include('partial.audit.tujuan_tertentu.form_default')
                                    @endif
                                @endif
                            @elseif($data3->id_pm == Auth::user()->id)
                                @if($data3->id_status_pt == 2)
                                    @include('partial.audit.kinerja.form_default')
                                @else
                                    @if ($data3->id_status_ketua == 2)
                                        @include('partial.audit.kinerja.form_setuju')
                                    @else
                                        @include('partial.audit.kinerja.form_default')
                                    @endif
                                @endif  
                            @elseif($data3->created_by == Auth::user()->id)
                                @if($data3->is_status == 1)
                                    @include('partial.audit.tujuan_tertentu.form_default') 
                                @else
                                    @include('partial.audit.tujuan_tertentu.form_field')
                                @endif
                            @else
                                @include('partial.audit.tujuan_tertentu.form_default')   
                            @endif
                        @else
                            @include('partial.audit.tujuan_tertentu.form_default') 
                        @endif  
                    @else
                        <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Audit Tujuan Tertentu<h3>
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
      $("#add_kertas_kinerja").click(function(){ 
          var lsthmtl = $('#upload_kertas_kinerja:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_kinerja:last');
      });
      $("#add_kertas_tujuan").click(function(){ 
          var lsthmtl = $('#upload_kertas_tujuan:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_tujuan:last');
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
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['datepicker', 'rangeslider']); });</script>
@endsection