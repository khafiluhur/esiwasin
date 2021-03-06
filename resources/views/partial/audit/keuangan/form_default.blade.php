<form action="{{ route('keuangan.audit') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Audit Keuangan</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Ketua Tim</label><span class="text-danger">*</span>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="">Pilih Nama Ketua Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ old('ketua') == $u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{ old('nomor_st') }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{rand()}}">
        </div>
        <div class="form-group">
            <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
            <select class="custom-select" id="pkpt" name="pkpt">
                <option value="">Pilih Penyerapan</option>
                @foreach($pkpt_keuangan as $u)
                <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal Audit</label><span class="text-danger">*</span>
            <div class="">
                <div class="form-group">
                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" value="{{ old('tanggal_audit_from') }}" placeholder="Dari" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">
                                s/d
                            </span>
                        </div>
                        <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" value="{{ old('tanggal_audit_to') }}" placeholder="Sampai" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                    </div>
                </div>    
            </div>
        </div>

        <div class="form-group">
            <label>Kertas Kerja</label><span class="text-danger">*</span>
            <div class="input-group custom-file hdtuto control-group lst increment" >
                <div class="col-10 float-left">
                    <input type="file" id="kertas_kerja" name="kertas_kerja[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('kertas_kerja') }}" multiple="multiple">
                    <label class="custom-file-label" for="kertas_kerja[]">Dokumen</label>
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-success" id="add_kertas_keuangan" onClick="GFG_Fun()" type="button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                <div class="col-10 float-left">
                    <input type="file" id="kertas_kerja" name="kertas_kerja[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('kertas_kerja') }}" multiple="multiple">
                    <label class="custom-file-label" for="kertas_kerja">Dokumen</label>
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label>Temuan</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Judul
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_judul" name="temuan_judul" placeholder="Input Judul Temua" value="{{ old('temuan_judul') }}">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Kondisi
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_kondisi" name="temuan_kondisi" placeholder="Input Kondisi Temua" value="{{ old('temuan_kondisi') }}">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Kriteria
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_kriteria" name="temuan_kriteria" placeholder="Input Kriteria Temua" value="{{ old('temuan_kriteria') }}">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Sebab
                </span>
            </div> 
            <textarea class="form-control" id="temuan_sebab" name="temuan_sebab" rows="4" placeholder="Input Sebab Temua" value="{{ old('temuan_sebab') }}">{{ old('temuan_sebab') }}</textarea>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Akibat
                </span>
            </div> 
            <textarea class="form-control" id="temuan_akibat" name="temuan_akibat" rows="4" placeholder="Input Akibat Temua" value="{{ old('temuan_akibat') }}">{{ old('temuan_akibat') }}</textarea>
        </div>
    </div>
</div>  

<div class="content">
    <label>Komentar</label><span class="text-danger">*</span>
    <div class="form-group">
        <div class="input-group">
            <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Input Komentar">{{ old('komentar') }}</textarea>
        </div>
    </div>    
</div>

<div class="block">
    <div class="block-header">
        <div class="col-12">
            <h3 class="block-title">Progress Approval</h3>
        </div>
    </div>
    <div class="block-content">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Stage
                            </th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 15%;">Jam</th>
                            <th class="text-center">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"></td>
                            <td class="font-w600 font-size-sm"></td>
                            <td class="font-size-sm"></td>
                            <td></td>
                            <td class="text-center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>

<div class="block-header block-header-default">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <!-- <button type="save" class="btn btn-sm btn-secondary" name="simpan" value="simpan">
            Simpan
        </button> -->
        <button type="submit" class="btn btn-sm btn-primary" name="kirim" value="kirim">
            Kirim
        </button>
    </div>
</div>
</form>