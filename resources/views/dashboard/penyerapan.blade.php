@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">PENYERAPAN
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">
                    Tambah
                </button>

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
            </nav>
        </div>
    </div>
</div>

<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">Kegiatan</th>
                        <th>Uraian Kegiatan</th>
                        <th class="d-none d-sm-table-cell">Volume</th>
                        <th class="d-none d-sm-table-cell">MAK</th>
                        <th class="d-none d-sm-table-cell">Anggaran</th>
                        <th class="d-none d-sm-table-cell">Realisasi</th>
                        <th class="d-none d-sm-table-cell">Saldo</th>
                        <th class="d-none d-sm-table-cell">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $u)
                    <tr>
                        <td class="text-center font-size-sm">{{$u->kegiatan}}</td>
                        <td class="font-w600 font-size-sm">{{$u->uraian_kegiatan}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{$u->volume}}
                        </td>
                        <td class="d-none d-sm-table-cell">{{$u->mak}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @currency($u->biaya)
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @currency($u->realisasi)
                        </td>
                        @if(!$u->realisasi == 0)
                        <td class="d-none d-sm-table-cell">
                            @currency($u->saldo)
                        </td>
                        @else
                        <td class="d-none d-sm-table-cell">
                            @currency($u->biaya)
                        </td>
                        @endif
                        <td class="d-none d-sm-table-cell">
                            <a href="{{route('detail.penyerapan', ['id' => $u->id ]) }}" class=" btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                            <a href="{{route('delete.pkpt.dokumentasi', ['id' => $u->id ]) }}" class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="content pt-0">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content block-content-full text-center">
            <div class="py-3">
                <canvas class="js-chartjs-bars"></canvas>
            </div>
        </div>
    </div>
</div>  

<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header" style="background-color: #D10102;">
                    <h3 class="block-title">Tambah Kegiatan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pkpt.dokumentasi') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kegiatan" type="text" class="form-control" name="kegiatan" value="{{ old('kegiatan') }}" required autocomplete="kegiatan" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Uraian Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="uraian_kegiatan" type="text" class="form-control" name="uraian_kegiatan" value="{{ old('uraian_kegiatan') }}" required autocomplete="uraian_kegiatan" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                                <div class="col-md-6">
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ old('volume') }}" required autocomplete="volume">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MAK') }}</label>

                                <div class="col-md-6">
                                    <input id="mak" type="number" class="form-control" name="mak" value="{{ old('mak') }}" required autocomplete="mak" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jenis') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="jenis" name="jenis">
                                        <option value="">Pilih Jenis</option>
                                        @foreach($jenis as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Anggaran') }}</label>

                                <div class="col-md-6">
                                    <input id="biaya" type="number" class="form-control" name="biaya" value="{{ old('biaya') }}" required autocomplete="biaya" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Realisasi') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasi" type="number" class="form-control" name="realisasi" value="{{ old('realisasi') }}" required autocomplete="realisasi" autofocus disabled>

                                </div>
                            </div>

                           <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Saldo') }}</label>

                                <div class="col-md-6">
                                    <input id="saldo" type="number" class="form-control" name="saldo" value="{{ old('saldo') }}" required autocomplete="saldo" autofocus disabled>

                                </div>
                            </div>

                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                <button type="sumbit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Ok</button>
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
<script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>

<script src="{{asset('/js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<script src="{{asset('/js/pages/be_comp_charts.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['easy-pie-chart', 'sparkline']); });</script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection