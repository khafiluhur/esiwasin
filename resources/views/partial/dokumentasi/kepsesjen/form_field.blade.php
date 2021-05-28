<form action="be_forms_wizard.html" method="POST">
<h3 style="text-align: center">Pengajuan NODIN</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Kepada</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Pilih Nama Ketua Tim</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Pilih Nama Anggota Tim</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tentang</label>
            <input class="form-control" type="text" id="wizard-simple-lastname" name="wizard-simple-lastname">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tanggal</label>
            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <input type="text" class="form-control" id="example-daterange1" name="example-daterange1" placeholder="Dari" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        s/d
                    </span>
                </div>
                <input type="text" class="form-control" id="example-daterange2" name="example-daterange2" placeholder="Sampai" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            </div>
        </div>
        <div class="form-group">
            <label>Landasan Hukum</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Input Landasan Hukum</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label></label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Input Landasan Hukum</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label></label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Input Landasan Hukum</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label for="example-textarea-input">Subtansi</label>
            <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label>Pilih Pejabat</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Pilih Nama Pejabat</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom">
                <option value="0">Pilih Jabatan</option>
                <option value="1">Dian Ayu P.</option>
            </select>
        </div>
        <div class="form-group">
            <label>Nomor NODIN</label>
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Nomor" id="wizard-simple-lastname" name="wizard-simple-lastname">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Kode Arsip" id="wizard-simple-lastname" name="wizard-simple-lastname">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Tahun" id="wizard-simple-lastname" name="wizard-simple-lastname">
            </div>    
        </div>   
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="example-textarea-input">Catatan Pengembalian Berkas</label>
            <textarea style="height: 981px;" class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4"></textarea>
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