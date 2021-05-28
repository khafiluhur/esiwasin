@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
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
            </h1>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#pengajuan_nodin" data-toggle="tab">Pengajuan Nodin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pengajuan_kepsesjen" data-toggle="tab">Pengajuan Kepsesjen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#input_pkpt" data-toggle="tab">Input PKPT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#input_notulen" data-toggle="tab">Input Notulen</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="pengajuan_nodin" role="tabpanel">
                        @if($data1)
                            @if($data1->created_by == Auth::user()->id)
                                @include('partial.dokumentasi.nodin.field') 
                            @else
                                @include('partial.dokumentasi.nodin.test') 
                            @endif
                        @else
                            @include('partial.dokumentasi.nodin.test') 
                        @endif
                    </div>

                    <div class="tab-pane" id="pengajuan_kepsesjen" role="tabpanel">
                        @if($data2)
                            @if($data2->created_by == Auth::user()->id)
                                @include('partial.dokumentasi.kepsesjen.field') 
                            @else
                                @include('partial.dokumentasi.kepsesjen.test') 
                            @endif
                        @else
                            @include('partial.dokumentasi.kepsesjen.test') 
                        @endif
                    </div>

                    <div class="tab-pane" id="input_pkpt" role="tabpanel">
                        @include('partial.dokumentasi.pkpt.test') 
                        
                    </div>   

                    <div class="tab-pane" id="input_notulen" role="tabpanel">
                    @if(!$pkpt_notulensi->isEmpty())
                        @include('partial.dokumentasi.notulensi.test') 
                    @else
                    <h3 class="text-center m-lg-7"> Belum ada Penyerapan Dana Untuk Dokumentasi Notulensi <h3>
                    @endif
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-simple-step1" data-toggle="tab">Pengajuan NODIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step2" data-toggle="tab">Pengajuan Per/Kepsesjen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step3" data-toggle="tab">Input PKPT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step4" data-toggle="tab">Input Notulen</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">
                    
                    <div class="tab-pane active" id="wizard-simple-step1" role="tabpanel">
                        <form action="{{route('nodim.dokumentasi')}}" method="POST">
                            @csrf
                            <h3 style="text-align: center">Pengajuan NODIN</h3>
                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label>Kepada</label>
                                        <select class="custom-select" id="ketua_nodim" name="ketua">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dari</label>
                                        <select class="custom-select" id="anggota_nodin" name="anggota">
                                            <option value="0">Pilih Nama Anggota Tim</option>
                                            @foreach($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dasar</label>
                                        <select class="custom-select" id="dasar" name="dasar[]">
                                            <option value="0">Input Dasar</option>
                                            @foreach($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-6 float-right">
                                    <div class="form-group">
                                        <label for="wizard-simple-lastname">Hal</label>
                                        <input class="form-control" type="text" placeholder="Input Hal" id="nomor_st_nodin" name="nomor_st">
                                    </div>
                                    <div class="form-group">
                                        <label for="wizard-simple-lastname">Tanggal</label>
                                        <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                                            <input type="text" class="js-flatpickr form-control bg-white" id="tanggal" name="tanggal" placeholder="Tanggal" data-date-format="d-m-Y">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="example-textarea-input">Isi Nodin</label>
                                        </div>
                                        <textarea class="form-control" id="catatan_nodim" name="catatan" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor NODIN</label>
                                        <div class="input-group">
                                            <span class="input-group-text font-w600">
                                                    ND-
                                                </span>
                                            <input class="form-control" type="text" placeholder="Nomor" id="nomor_nodin" name="nomor">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text font-w600">
                                                    /
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" placeholder="Kode Arsip" id="kode_arsip_nodin" name="kode_arsip">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text font-w600">
                                                    /
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" placeholder="Tahun" id="tahun_nodin" name="tahun">
                                        </div>    
                                    </div> 
                                    <div class="form-group">
                                        <label for="example-textarea-input">Tembusan</label>
                                        <textarea class="form-control" placeholder="Input Tembusan" id="subtansi_nodin" name="subtansi" rows="4"></textarea>
                                    </div> 
                                </div>
                            </div>

                            <div class="block-header block-header-default col-12">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Simpan
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Unduh
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>    

                    <div class="tab-pane" id="wizard-simple-step2" role="tabpanel">
                        @include('partial.dokumentasi.kepsesjen.form_default')
                    </div>

                    <div class="tab-pane" id="wizard-simple-step3" role="tabpanel">
                        <h3 style="text-align: center">INPUT PROGRAM KERJA DAN ANGGARAN</h3>
                        <div class="content">
                            <div class="block">
                                <div class="block-content block-content-full">
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kegiatan</th>
                                                <th>Uraigan Kegiatan</th>
                                                <th class="d-none d-sm-table-cell">MAK</th>
                                                <th class="d-none d-sm-table-cell">Biaya</th>
                                                <th class="d-none d-sm-table-cell">Output</th>
                                                <th class="d-none d-sm-table-cell">Volume</th>
                                                <th class="d-none d-sm-table-cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $u)
                                            <tr>
                                                <td class="text-center font-size-sm">{{$u->kegiatan}}</td>
                                                <td class="font-w600 font-size-sm">{{$u->uraian_kegiatan}}</td>
                                                <td class="d-none d-sm-table-cell font-size-sm">
                                                    {{$u->mak}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">{{$u->biaya}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {{$u->output}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {{$u->volume}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="" class=" btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger" type="submit"><i class="fas fa-download"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="tab-pane" id="wizard-simple-step4" role="tabpanel">
                        @include('partial.dokumentasi.notulensi.form_default')
                    </div>
                    
                </div>

            </div>

        </div>

    </div>
</div> -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
      $("#add_dasar").click(function(){ 
          var lsthmtl = $('#form_dasar:last').clone();
          $(lsthmtl).insertAfter('#form_dasar:last');
      });
      $("#add_landasan").click(function(){ 
          var lsthmtl = $('#form_landasan:last').clone();
          $(lsthmtl).insertAfter('#form_landasan:last');
      });
      $("#add_peserta").click(function(){ 
          var lsthmtl = $('#form_peserta:last').clone();
          $(lsthmtl).insertAfter('#form_peserta:last');
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

<script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>
<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection