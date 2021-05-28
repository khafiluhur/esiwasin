<form action="{{ route('rkbmn.review') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Reviu RKBMN</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Ketua Tim</label>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Ketua Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ old('ketua') == $u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{ old('nomor_st') }}">
            <input class="form-control" type="hidden" id="kode7" name="kode" value="{{rand()}}">
        </div>
        <div class="form-group">
            <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
            <select class="custom-select" id="pkpt" name="pkpt">
                <option value="">Pilih Penyerapan</option>
                @foreach($pkpt_rkbmn as $u)
                <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal Reviu</label>
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
        <div class="">
            <div class="form-group">
                <label>Kertas Kerja</label>
                <div class="input-group custom-file hdtuto control-group lst increment" >
                    <div class="col-10 float-left">
                        <input type="file" id="kertas_kerja" name="kertas_kerja[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('kertas_kerja') }}" multiple="multiple">
                        <label class="custom-file-label" for="kertas_kerja[]">Dokumen</label>
                    </div>
                    <div class="input-group-btn col-2 float-left"> 
                        <button class="btn btn-success" id="add_kertas_rkbmn" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_rkbmn" style="margin-top:10px" >
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
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label>Temuan</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Penjelasan
                </span>
            </div> 
            <textarea class="form-control" id="temuan_sebab" name="temuan_akibat" rows="4" placeholder="Input Penjelasan Temuan" value="{{ old('temuan_akibat') }}"></textarea>
        </div>
    </div>
</div>  

<div class="content">
    <label>Komentar</label>
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