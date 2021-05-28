<form action="{{ route('nodim.dokumentasi') }}" method="POST">
@csrf

<h3 style="text-align: center">Pengajuan NODIN</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Kepada</label>
            <select class="custom-select" id="ketua_nodim" name="ketua">
                <option value="0">Pilih Nama Ketua Tim</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label>
            <select class="custom-select" id="anggota_nodin" name="anggota">
                <option value="0">Pilih Nama Anggota Tim</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dasar</label>
            <select class="custom-select" id="dasar" name="dasar[]">
                <option value="0">Input Dasar</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div> 
    </div>
    <div class="col-6 float-right">
         <div class="form-group">
            <label for="wizard-simple-lastname">Hal</label>
            <input class="form-control" type="text" placeholder="Input Hal" id="nomor_st_nodin" name="nomor_st"/>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tanggal</label>
            <div class="input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                <input type="text" class="js-flatpickr form-control bg-white" id="tanggal" name="tanggal" placeholder="Tanggal" data-date-format="d-m-Y">
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="example-textarea-input">Isi Nodin</label>
            </div>
            <textarea class="form-control" id="catatan_nodim" name="catatan" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label>Nomor NODIN</label>
            <div class="input-group">
                <span class="input-group-text font-w600">
                        ND-
                    </span>
                <input class="form-control" type="text" placeholder="Nomor" id="nomor_nodin" name="nomor">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Kode Arsip" id="kode_arsip_nodin" name="kode_arsip">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Tahun" id="tahun_nodin" name="tahun">
            </div>    
        </div> 
        <div class="form-group">
            <label for="example-textarea-input">Tembusan</label>
            <textarea class="form-control" placeholder="Input Tembusan" id="subtansi_nodin" name="subtansi" rows="4"></textarea>
        </div> 
    </div>
</div>

<div class="block-header block-header-default col-12">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="submit" class="btn btn-sm btn-primary">
            Simpan
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
            Unduh
        </button>
    </div>
</div>
</form>