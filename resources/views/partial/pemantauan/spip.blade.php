
<h3 style="text-align: center">Pemantauan SPIP</h3>
<div class="col-12">
    <div class="">
        <div class="form-group">
            <div class="col-6 float-left">
                <label for="wizard-simple-firstname">Periode Laporan</label>
                <div class="form-group">
                    <div class="input-daterange input-group col-10 float-left pl-0" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="example-daterange1" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">
                                s/d
                            </span>
                        </div>
                        <input type="text" class="form-control" id="example-daterange2" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                    </div>
                    <div class="form-group col-1 float-left">
                        <button type="submit" class="btn btn-sm btn-warning">
                            Cari
                        </button>
                    </div>
                </div>    
            </div>
            <div class="form-group col-6 float-right mt-4 mb-0">
            <div class="float-right">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-block-normal2">
                    Tambah Berkas
                </button>
            </div>
        </div> 
        </div>
    </div>
</div>

<div class="">
    <div class="block">
        <div class="mb-3 text-center">
        </div>
        <div class="block-content block-content-full mt-7">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Keterangan</th>
                        <th class="d-none d-sm-table-cell">Berkas</th>
                        <th class="d-none d-sm-table-cell">Tanggal</th>
                        <th>Tahun</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data3 as $key => $u)
                        <tr>
                            <td class="text-center font-size-sm">{{$key+1}}</td>
                            <td class="font-w600 font-size-sm">{{ $u->keterangan }}</td>
                            <td class="d-none d-sm-table-cell font-size-sm"><a href="{{ route('pemantauan.bpk.download', ['file' => $u->id ]) }}"" class="">{{ $u->berkas_temuan }}</a></td>
                            <td class="d-none d-sm-table-cell font-size-sm">{{ $u->tanggal }}</td>
                            <td class="d-none d-sm-table-cell font-size-sm">{{ $u->tahun }}</td>
                            @if($u->status == 1)
                                <td class="d-none d-sm-table-cell">Tunda</td>
                            @elseif($u->status == 2)
                                <td class="d-none d-sm-table-cell">Selesai</td>
                            @else
                                <td class="d-none d-sm-table-cell">Batal</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="modal-block-normal2" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header" style="background-color: #D10102;">
                    <h3 class="block-title">Tambah Temuan SPIP</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('spip.pemantauan') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="input-group">
                                    <label>Keterangan</label><span class="text-danger">*</span>
                                </div>
                                <div class="input-group">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Input Keterangan" value="{{ old('keterangan') }}">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
                                <select class="custom-select" id="pkpt" name="pkpt">
                                    <option value="">Pilih Penyerapan</option>
                                    @foreach($pkpt_spip as $u)
                                    <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Berkas</label><span class="text-danger">*</span>
                                </div>
                                <div class="input-group custom-file hdtuto control-group lst" id="upload_berkas" style="margin-top:10px" >
                                    <div class="">
                                        <input type="file" id="berkas" name="berkas" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('berkas') }}" multiple="multiple">
                                        <label class="custom-file-label" for="berkas">Dokumen</label>
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="input-group">
                                    <label>Tanggal</label><span class="text-danger">*</span>
                                </div>
                                <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                                    <input type="text" class="js-flatpickr form-control bg-white" id="tanggal" name="tanggal" placeholder="Tanggal" data-date-format="d-m-Y">
                                    <input class="form-control" type="hidden" id="kode" name="kode" value="{{rand()}}">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="input-group">
                                    <label>Tahun</label><span class="text-danger">*</span>
                                </div>
                                <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                                    <input type="text" class="form-control bg-white" id="tahun" name="tahun" placeholder="Tahun">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label>Status</label><span class="text-danger">*</span>
                                </div>
                                <select class="custom-select" id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="1" {{ old('ketua') == 1? 'selected' : '' }}>Tunda</option>
                                    <option value="2" {{ old('ketua') == 2? 'selected' : '' }}>Selesai</option>
                                    <option value="3" {{ old('ketua') == 3? 'selected' : '' }}>Batal</option>
                                </select>
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