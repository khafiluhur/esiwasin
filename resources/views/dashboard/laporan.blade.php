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
                        <a class="nav-link active" href="#wizard-simple-step1" data-toggle="tab">Laporan Hasil Audit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step2" data-toggle="tab">Laporan Hasil Reviu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step3" data-toggle="tab">Laporan Hasil Evaluasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step4" data-toggle="tab">Laporan Hasil Pemantauan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step6" data-toggle="tab">Laporan Hasil Pengawasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step5" data-toggle="tab">Laporan Hasil Notulensi</a>
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="wizard-simple-step1" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Audit</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        

                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Audit</th>
                                                    <th>Periode Audit</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th class="d-none d-sm-table-cell">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($audit as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal_audit_from }} s/d {{$u->tanggal_audit_to}}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->ketua }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a href="{{route('audit.laporan', ['id' => $u->audit])}}">unduh laporan</a>
                                                        <input class="form-control" type="hidden" id="jenis" name="jenis" value="{{$u->jenis}}">
                                                    </td>
                                                    <td>
                                                        <a href="{{route('audit.download.laporan', ['id' => $u->audit ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="tab-pane" id="wizard-simple-step2" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Reviu</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>


                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Reviu</th>
                                                    <th>Periode Reviu</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reviu as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal_reviu_from }} s/d {{$u->tanggal_reviu_to}}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->ketua }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a  href="{{route('reviu.laporan', ['id' => $u->reviu])}}">unduh laporan</a>
                                                        <input class="form-control" type="hidden" id="jenis" name="jenis" value="{{$u->jenis}}">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('reviu.download.laporan', ['id' => $u->reviu ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="wizard-simple-step3" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Evaluasi</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>


                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Evaluasi</th>
                                                    <th>Periode Evaluasi</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($evaluasi as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal_evaluasi_from }} s/d {{$u->tanggal_evaluasi_to}}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->ketua }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a target="_blank" href="{{route('evaluasi.laporan', ['id' => $u->evaluasi])}}">unduh laporan</a>
                                                        <input class="form-control" type="hidden" id="jenis" name="jenis" value="{{$u->jenis}}">
                                                    </td>
                                                    <td>
                                                        <a target="_blank" href="{{ route('evaluasi.download.laporan', ['id' => $u->evaluasi  ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>  
                    
                    <div class="tab-pane" id="wizard-simple-step4" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Pemantauan</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Pemantauan</th>
                                                    <th>Periode Pemantauan</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemantauan as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal_pemantauan_from }} s/d {{$u->tanggal_pemantauan_to}}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->ketua }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a href="{{route('pemantauan.laporan', ['id' => $u->pemantauan])}}">unduh laporan</a>
                                                        <input class="form-control" type="hidden" id="jenis" name="jenis" value="{{$u->jenis}}">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pemantauan.download.laporan', ['id' => $u->pemantauan ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="tab-pane" id="wizard-simple-step6" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Pengawasan</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Pengawasan</th>
                                                    <th>Periode Pengawasan</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengawasan as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal_pengawasan_from }} s/d {{$u->tanggal_pengawasan_to}}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->ketua }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a href="{{route('pengawasan.laporan', ['id' => $u->pengawasan])}}">unduh laporan</a>
                                                        <input class="form-control" type="hidden" id="jenis" name="jenis" value="{{$u->jenis}}">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pengawasan.download.laporan', ['id' => $u->pengawasan ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="tab-pane" id="wizard-simple-step5" role="tabpanel">
                        <form action="{{ route('audit.cari.laporan') }}" method="GET">
                            <h3 style="text-align: center">Laporan Hasil Notulen</h3>
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="wizard-simple-firstname">Periode Laporan</label>
                                            <div class="">
                                            <div class="form-group">
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="periode_from_audit" value="{{ old('periode_from_audit') }}" name="periode_from_audit" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <div class="input-group-prepend input-group-append">
                                                        <span class="input-group-text font-w600">
                                                            s/d
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="periode_to_audit" value="{{ old('periode_to_audit') }}" name="periode_to_audit" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua</label>
                                        <select class="custom-select" id="ketua_audit" name="ketua_audit">
                                            <option value="0">Pilih Nama Ketua Tim</option>
                                            @foreach($anggota as $u)
                                            <option value="{{$u->id}}" {{ old('ketua_audit') == $u->id ? 'selected' : '' }}>{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="mt-5">
                                <div class="block">
                                    <div class="mb-3 text-center">
                                    </div>
                                    <div class="block-content block-content-full">
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Notulen</th>
                                                    <th>Periode Notulen</th>
                                                    <th class="d-none d-sm-table-cell">Anggota Tim</th>
                                                    <th class="d-none d-sm-table-cell">Ketua Tim</th>
                                                    <th class="d-none d-sm-table-cell">Laporan</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notullen as $u)
                                                <tr>
                                                    <td class="text-center font-size-sm">
                                                        <a href="{{route('detail.pkpt.dokumentasi', ['id' => $u->id_pkpt])}}">
                                                            {{ $u->nama_pkpt }}
                                                        </a>
                                                    </td>
                                                    <td class="font-w600 font-size-sm">{{ $u->tanggal }}</td>
                                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->created_by }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $u->pimpinan }}</td>
                                                    <td class="d-none d-sm-table-cell">
                                                        <a href="{{route('notulensi.laporan', ['id' => $u->kode])}}">unduh laporan</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('notulensi.download.laporan', ['id' => $u->kode ]) }}">unduh dokumen</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
<script src="{{asset('/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection