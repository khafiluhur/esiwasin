@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">
                    Tambah User
                </button>
            </nav>
        </div>
    </div>
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

<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">NRP/NIP</th>
                        <th>Nama</th>
                        <th class="d-none d-sm-table-cell">Jabatan</th>
                        <th class="d-none d-sm-table-cell">Level</th>
                        <th class="d-none d-sm-table-cell">Aktif/Tidak</th>
                        <th class="d-none d-sm-table-cell">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($table as $u)
                    <tr>
                        <td class="text-center font-size-sm">{{$u->nip}}</td>
                        <td class="font-w600 font-size-sm">{{$u->nama}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{$u->jabatan}}
                        </td>
                        <td class="d-none d-sm-table-cell">{{$u->level}}
                        </td>
                        @if($u->is_active == 1)
                        <td class="d-none d-sm-table-cell">
                            Aktif
                        </td>
                        @else
                        <td class="d-none d-sm-table-cell">
                            Tidak Aktif
                        </td>
                        @endif
                        <td class="d-none d-sm-table-cell">
                            <a href="{{ route('ubah.useradmin',['id'=>$u->id]) }}" class=" btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
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
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('tambah.useradmin') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP/NRP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="jabatan" name="jabatan">
                                        <option value="0">Pilih Jabatan</option>
                                        @foreach ($jabatan as $u)
                                        <option value="{{$u->id}}">{{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="level" name="level">
                                        <option value="0">Pilih Level</option>
                                        @foreach ($level as $u)
                                        <option value="{{$u->id}}">{{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
 
                             <div id="ket-an" class="form-group row d-none">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Ketua') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select level" id="ketua" name="ketua">
                                        <option value="0">Pilih Ketua</option>
                                        @foreach ($ketua as $u)
                                        <option value="{{$u->id}}">{{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="peng-tek" class="form-group row d-none">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Pengendali Teknis') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="pt" name="pt">
                                        <option value="0">Pilih Pengendali Teknis</option>
                                        @foreach ($pt as $u)
                                        <option value="{{$u->id}}">{{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="peng-mutu" class="form-group row d-none">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Pengendali Mutu') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="pm" name="pm">
                                        <option value="0">Pilih Pengendali Mutu</option>
                                        @foreach ($pm as $u)
                                        <option value="{{$u->id}}">{{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_active" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="example-radio-custom-inline1" name="is_active" value="1">
                                        <label class="custom-control-label" for="example-radio-custom-inline1">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="example-radio-custom-inline2" name="is_active" value="0" checked>
                                        <label class="custom-control-label" for="example-radio-custom-inline2">Tidak</label>
                                    </div>
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
<script>

    $('#level').on('change', function () {
    if(this.value == 1) {
        $("#peng-tek").removeClass("d-none");
        $("#peng-mutu").removeClass("d-none");
        $("#ket-an").addClass("d-none");
    } else if (this.value == 2) {
        $("#peng-tek").addClass("d-none");
        $("#peng-mutu").addClass("d-none");
        $("#ket-an").removeClass("d-none");
    } else {
        $("#peng-tek").addClass("d-none");
        $("#peng-mutu").addClass("d-none");
        $("#ket-an").addClass("d-none");
    }
    });
</script>
<script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection