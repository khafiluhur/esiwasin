@extends('layouts.app')

@section('style')
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
                        <a class="nav-link active" href="#konsultasi" data-toggle="tab">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pelatiahan" data-toggle="tab">Sosialisai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#koordinasi" data-toggle="tab">Asistensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reformasi" data-toggle="tab">RBZI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sakip" data-toggle="tab">SAKIP</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="konsultasi" role="tabpanel">
                    @if(!$pkpt_konsultasi->isEmpty())
                        @if($data1)
                            @if($data1->id_anggota == Auth::user()->id)
                                @include('partial.pengawasan.konsultasi.form_setuju') 
                            @elseif($data1->id_users_ketua == Auth::user()->id)
                                @include('partial.pengawasan.konsultasi.form_setuju')  
                            @elseif($data1->id_pt == Auth::user()->id)
                                @include('partial.pengawasan.konsultasi.form_setuju')  
                            @elseif($data1->id_pm == Auth::user()->id)
                                @include('partial.pengawasan.konsultasi.form_setuju')     
                            @elseif($data1->created_by == Auth::user()->id)
                                @include('partial.pengawasan.konsultasi.form_field')
                            @else
                                @include('partial.pengawasan.konsultasi.form_default') 
                            @endif
                        @else
                            @include('partial.pengawasan.konsultasi.form_default')
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pengawasan Konsultasi <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="koordinasi" role="tabpanel">
                    @if(!$pkpt_asistensi->isEmpty())
                        @if($data2)
                            @if($data2->id_anggota == Auth::user()->id)
                                @include('partial.pengawasan.pelatihan.form_setuju') 
                            @elseif($data2->id_users_ketua == Auth::user()->id)
                                @include('partial.pengawasan.pelatihan.form_setuju')  
                            @elseif($data2->id_pt == Auth::user()->id)
                                @include('partial.pengawasan.pelatihan.form_setuju')   
                            @elseif($data2->id_pm == Auth::user()->id)
                                @include('partial.pengawasan.pelatihan.form_setuju')    
                            @elseif($data2->created_by == Auth::user()->id)
                                @include('partial.pengawasan.pelatihan.form_field')
                            @else
                                @include('partial.pengawasan.pelatihan.form_default')
                            @endif
                        @else
                            @include('partial.pengawasan.pelatihan.form_default')
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pengawasan Asistensi <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="pelatiahan" role="tabpanel">
                    @if(!$pkpt_sosialisasi->isEmpty())
                        @if($data3)
                            @if($data3->id_anggota == Auth::user()->id)
                                @include('partial.pengawasan.koordinasi.form_setuju')
                            @elseif($data3->id_users_ketua == Auth::user()->id)
                                @include('partial.pengawasan.koordinasi.form_setuju') 
                            @elseif($data3->id_pt == Auth::user()->id)
                                @include('partial.pengawasan.koordinasi.form_setuju')   
                            @elseif($data3->id_pm == Auth::user()->id)
                                @include('partial.pengawasan.koordinasi.form_setuju')   
                            @elseif($data3->created_by == Auth::user()->id)
                                @include('partial.pengawasan.koordinasi.form_field')
                            @else
                                @include('partial.pengawasan.koordinasi.form_default')
                            @endif
                        @else
                            @include('partial.pengawasan.koordinasi.form_default')
                        @endif
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pengawasan Sosialisasi <h3>
                    @endif
                    </div>  
                    
                    <div class="tab-pane" id="reformasi" role="tabpanel">
                    @if(!$pkpt_rbzi->isEmpty())
                        <form action="{{ route('reformasi.pengawasan') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h3 style="text-align: center">Laporan UPG, Benturan Kepentingan, WBS, TPKN, DUMAS</h3>
                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="pkpt" name="pkpt">
                                            <option value="">Pilih Penyerapan</option>
                                            @foreach($pkpt_rbzi as $u)
                                            <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Laporan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="jenis" name="jenis">
                                            <option value="0">Pilih Jenis Laporan</option>
                                            @foreach($jenis as $u)
                                            <option value="{{$u->id}}">{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Periode Laporan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="periode" name="periode">
                                            <option value="0">Pilih Periode Laporan</option>
                                            @foreach($periode as $u)
                                            <option value="{{$u->id}}">{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Input Laporan</label><span class="text-danger">*</span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="laporan" name="laporan[]" value="{{ old('laporan') }}">
                                            <label class="custom-file-label" for="example-file-input-custom">Dokumen</label>
                                            <input class="form-control" type="hidden" id="kode16" name="kode" value="{{rand()}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="">
                                        <div class="form-group">
                                            <label>Add Laporan</label>
                                            <div class="input-group custom-file hdtuto control-group lst increment" >
                                                <div class="col-10 float-left">
                                                    <input type="file" id="kertas_kerja" name="laporan[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('laporan') }}" multiple="multiple">
                                                    <label class="custom-file-label" for="kertas_kerja[]">Dokumen</label>
                                                </div>
                                                <div class="input-group-btn col-2 float-left"> 
                                                    <button class="btn btn-success" id="add_kertas_pengawasan_reformasi" type="button"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_pengawasan_reformasi" style="margin-top:10px" >
                                                <div class="col-10 float-left">
                                                    <input type="file" id="kertas_kerja" name="laporan[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('laporan') }}" multiple="multiple">
                                                    <label class="custom-file-label" for="kertas_kerja">Dokumen</label>
                                                </div>
                                                <div class="input-group-btn col-2 float-left"> 
                                                    <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="block-header block-header-default col-12">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>

                        </form>
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pengawasan RBZI <h3>
                    @endif
                    </div>

                    <div class="tab-pane" id="sakip" role="tabpanel">
                    @if(!$pkpt_sakip->isEmpty())
                        <form action="{{route('sakip.pengawasan')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h3 style="text-align: center">Sistem Akuntabilitas Kinerja Instansi Pemerintah</h3>
                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="pkpt" name="pkpt">
                                            <option value="">Pilih Penyerapan</option>
                                            @foreach($pkpt_sakip as $u)
                                            <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Laporan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="jenis" name="jenis">
                                            <option value="0">Pilih Jenis Laporan</option>
                                            @foreach($jenis as $u)
                                            <option value="{{$u->id}}">{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Periode Laporan</label><span class="text-danger">*</span>
                                        <select class="custom-select" id="periode" name="periode">
                                            <option value="0">Pilih Periode Laporan</option>
                                            @foreach($periode as $u)
                                            <option value="{{$u->id}}">{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Input Laporan</label><span class="text-danger">*</span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="laporan" name="laporan[]">
                                            <label class="custom-file-label" for="example-file-input-custom">Dokumen</label>
                                            <input class="form-control" type="hidden" id="kode17" name="kode" value="{{rand()}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="">
                                        <div class="form-group">
                                            <label>Add Laporan</label>
                                            <div class="input-group custom-file hdtuto control-group lst increment" >
                                                <div class="col-10 float-left">
                                                    <input type="file" id="kertas_kerja" name="laporan[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('laporan') }}" multiple="multiple">
                                                    <label class="custom-file-label" for="kertas_kerja[]">Dokumen</label>
                                                </div>
                                                <div class="input-group-btn col-2 float-left"> 
                                                    <button class="btn btn-success" id="add_kertas_pengawasan_sakip" type="button"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_pengawasan_sakip" style="margin-top:10px" >
                                                <div class="col-10 float-left">
                                                    <input type="file" id="kertas_kerja" name="laporan[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('laporan') }}" multiple="multiple">
                                                    <label class="custom-file-label" for="kertas_kerja">Dokumen</label>
                                                </div>
                                                <div class="input-group-btn col-2 float-left"> 
                                                    <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="block-header block-header-default col-12">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Pengawasan SAKIP <h3>
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
      $("#add_kertas_pengawasan_reformasi").click(function(){ 
          var lsthmtl = $('#upload_kertas_pengawasan_reformasi:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_pengawasan_reformasi:last');
      });
      $("#add_kertas_pengawasan_sakip").click(function(){ 
          var lsthmtl = $('#upload_kertas_pengawasan_sakip:last').clone();
          $(lsthmtl).insertAfter('#upload_kertas_pengawasan_sakip:last');
      });
      $("body").on("click",".btn-danger",function(){ 
          console.log("delete");
          $(this).parents(".hdtuto").remove();
      });
    });
</script>
<script>
function myFunction() {
  var a = document.getElementById("button-konsultasi");
  var w = document.getElementById("colum1");
  var x = document.getElementById("colum2");
  var y = document.getElementById("colum3");
  var z = document.getElementById("colum4");
  if (x.style.display === "none") {
    w.style.display = "block";
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
  } else {
    a.style.display = "block";
  }
}

function myPelatihan() {
  var a = document.getElementById("button-pelatihan");
  var w = document.getElementById("columpelatihan1");
  var x = document.getElementById("columpelatihan2");
  var y = document.getElementById("columpelatihan3");
  var z = document.getElementById("columpelatihan4");
  if (x.style.display === "none") {
    w.style.display = "block";
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
  } else {
    a.style.display = "block";
  }
}

function myKoordinasi() {
  var a = document.getElementById("button-koordinasi");
  var w = document.getElementById("columkoordinasi1");
  var x = document.getElementById("columkoordinasi2");
  var y = document.getElementById("columkoordinasi3");
  var z = document.getElementById("columkoordinasi4");
  if (x.style.display === "none") {
    w.style.display = "block";
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
  } else {
    a.style.display = "block";
  }
}
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