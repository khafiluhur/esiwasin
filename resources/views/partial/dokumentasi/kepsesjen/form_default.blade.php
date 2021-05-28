<form action="{{route('kepseajen.dokumentasi')}}" method="POST">
@csrf

<h3 style="text-align: center">Pengajuan Kepsesjen</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Kepada</label>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Ketua Tim</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label>
            <select class="custom-select" id="anggota" name="anggota">
                <option value="0">Pilih Nama Anggota Tim</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tentang</label>
            <input class="form-control" type="text" placeholder="tentang" id="tentang" name="tentang">
            <input class="form-control" type="hidden" id="kode2" name="kode">
        </div>  
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="wizard-simple-lastname">Tanggal</label>
            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" placeholder="Dari" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        s/d
                    </span>
                </div>
                <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" placeholder="Sampai" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            </div>
        </div>
        <div class="form-group">
            <label>Pilih Pejabat</label>
            <select class="custom-select" id="pejabat" name="pejabat">
                <option value="0">Pilih Nama Pejabat</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select class="custom-select" id="jabatan" name="jabatan">
                <option value="0">Pilih Jabatan</option>
                @foreach($jabatan as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Landasan Hukum</label>
            <select class="custom-select" id="landasan_hukum1" name="landasan_hukum1">
                <option value="0">Input Landasan Hukum</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="example-textarea-input">Isi Per/kepsesjen</label>
            </div>
            <textarea class="form-control" id="catatan" name="catatan" rows="4"></textarea>
        </div>
         <div class="form-group">
            <label for="example-textarea-input">Lampiran</label>
            <textarea class="form-control" placeholder="Lampiran" id="lampiran" name="subtansi" rows="4"></textarea>
        </div>
        
        <div class="form-group">
            <label>Nomor Kep/Per</label>
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Nomor" id="nomor" name="nomor">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Kode Arsip" id="kode_arsip" name="kode_arsip">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Tahun" id="tahun" name="tahun">
            </div>    
        </div> 
    </div>
</div>

<div class="block-header block-header-default col-12">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="submit" class="btn btn-sm btn-primary">
            Simpan
        </button>
    </div>
</div>
</form>