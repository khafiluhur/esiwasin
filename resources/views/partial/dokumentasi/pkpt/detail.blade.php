
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
            <h3 style="text-align: center">PROGRAM KERJA DAN ANGGARAN</h3>
<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <!-- <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">
                    Tambah Program
                </button> -->
                <thead>
                    <tr>
                        <th class="text-center">Kegiatan</th>
                        <th>Uraigan Kegiatan</th>
                        <th class="d-none d-sm-table-cell">MAK</th>
                        <th class="d-none d-sm-table-cell">Biaya</th>
                        <th class="d-none d-sm-table-cell">Output</th>
                        <th class="d-none d-sm-table-cell">Volume</th>
                        <th class="d-none d-sm-table-cell">Realisasi Output</th>
                        <th class="d-none d-sm-table-cell">Realisasi</th>
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
                        <td class="d-none d-sm-table-cell">@currency($u->biaya)
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{$u->output}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{$u->volume}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{$u->realisasi_output}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @currency($u->realisasi)
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header" style="background-color: #D10102;">
                    <h3 class="block-title">PKPT</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="card-body">
                        @foreach($data as $u)
                        <form method="POST" action="{{ route('edit.pkpt.dokumentasi', ['id' => $u->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kegiatan" type="text" class="form-control" name="kegiatan" value="{{ $u->kegiatan }}" required autocomplete="kegiatan" autofocus disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Uraian Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="uraian_kegiatan" type="text" class="form-control" name="uraian_kegiatan" value="{{ $u->uraian_kegiatan }}" required autocomplete="uraian_kegiatan" autofocus disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MAK') }}</label>

                                <div class="col-md-6">
                                    <input id="mak" type="number" class="form-control" name="mak" value="{{ $u->mak }}" required autocomplete="mak" autofocus disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Biaya') }}</label>

                                <div class="col-md-6">
                                    <input id="biaya" type="text" class="form-control" name="biaya" value="@currency($u->biaya)" required autocomplete="biaya" autofocus disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Output') }}</label>

                                <div class="col-md-6">
                                    <input id="output" type="number" class="form-control" name="output" value="{{ $u->output }}" required autocomplete="output" autofocus disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                                <div class="col-md-6">
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ $u->volume }}" required autocomplete="volume" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jenis') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="jenis" name="jenis" disabled>
                                        <option value="">Pilih Jenis</option>
                                        @foreach($jenis as $a)
                                        <option value="{{ $a->id }}" {{ ( $a->id == $u->jenis ) ? 'selected' : '' }}>{{ $a->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Realisasi') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasi" type="number" class="form-control" name="realisasi" value="{{ $u->realisasi }}" required autocomplete="realisasi" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Realisasi Output') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasi_output" type="number" class="form-control" name="realisasi_output" value="{{ $u->realisasi_output }}" required autocomplete="realisasi_output" autofocus>
                                </div>
                            </div>

                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                <button type="sumbit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Save</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
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