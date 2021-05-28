<h3 style="text-align: center">INPUT PROGRAM KERJA DAN ANGGARAN</h3>
<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">
                    Tambah Program
                </button>
                <thead>
                    <tr>
                        <th class="text-center">Kegiatan</th>
                        <th>Uraigan Kegiatan</th>
                        <th class="d-none d-sm-table-cell">MAK</th>
                        <th class="d-none d-sm-table-cell">Biaya</th>
                        <th class="d-none d-sm-table-cell">Output</th>
                        <th class="d-none d-sm-table-cell">Volume</th>
                        <th class="d-none d-sm-table-cell">Realisasi</th>
                        <th class="d-none d-sm-table-cell"></th>
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
                            {{$u->realisasi}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <a href="{{route('detail.penyerapan', ['id' => $u->id ]) }}" class=" btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                            <a href="{{route('delete.pkpt.dokumentasi', ['id' => $u->id ]) }}" class=" btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                    <h3 class="block-title">Input PKPT</h3>
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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MAK') }}</label>

                                <div class="col-md-6">
                                    <input id="mak" type="number" class="form-control" name="mak" value="{{ old('mak') }}" required autocomplete="mak" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Biaya') }}</label>

                                <div class="col-md-6">
                                    <input id="biaya" type="number" class="form-control" name="biaya" value="{{ old('biaya') }}" required autocomplete="biaya" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Output') }}</label>

                                <div class="col-md-6">
                                    <input id="output" type="number" class="form-control" name="output" value="{{ old('output') }}" required autocomplete="output" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                                <div class="col-md-6">
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ old('volume') }}" required autocomplete="volume">
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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Realisasi') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasi" type="number" class="form-control" name="realisasi" value="{{ old('realisasi') }}" required autocomplete="realisasi" autofocus disabled>
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