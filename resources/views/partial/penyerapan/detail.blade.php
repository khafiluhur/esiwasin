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
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="penyerapan_pkpt" role="tabpanel">
                        <form action="{{ route('edit.penyerapan', ['id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <h3 style="text-align: center">PKPT</h3>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kegiatan</label>
                                        <input class="form-control" type="text" id="kegiatan" name="kegiatan" value="{{$data->kegiatan}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="uraian_kegiatan">Uraian Kegiatan</label>
                                        <input class="form-control" type="text" id="uraian_kegiatan" name="uraian_kegiatan" value="{{$data->uraian_kegiatan}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="volume">Volume</label>
                                        <input class="form-control" type="text" id="volume" name="volume" value="{{$data->volume}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="mak">MAK</label>
                                        <input class="form-control" type="text" id="mak" name="mak" value="{{$data->mak}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="jeni">Jenis</label>
                                        <select class="custom-select" id="jenis" name="jenis" disabled>
                                            <option value="">Pilih Jenis</option>
                                            @foreach($jenis as $u)
                                            <option value="{{ $u->id }}" {{ ( $u->id == $data->jenis ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="anggaran">Anggaran</label>
                                        <input class="form-control" type="text" id="anggaran" name="anggaran" value="@currency($data->biaya)" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="realisasi">Realisasi</label>
                                        <input class="form-control" type="text" id="realisasi" name="realisasi" value="@currency($data->realisasi)">
                                    </div>
                                    <div class="form-group">
                                        <label for="saldo">Saldo</label>
                                        <input class="form-control" type="text" id="saldo" name="saldo" value="@currency($data->saldo)" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="block-header block-header-default col-12">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary" name="kirim" value="kirim">
                                        Save
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
<script src="{{asset('/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/additional-methods.js')}}"></script>

<script src="{{asset('/js/pages/be_forms_wizard.min.js')}}"></script>

<script src="{{asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['datepicker', 'rangeslider']); });</script>
@endsection