<form action="{{route('nodim.dokumentasi')}}" method="POST">
@csrf

<h3 style="text-align: center">Input Notulen</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label for="wizard-simple-lastname">Nomor Undangan Rapat</label>
            <input class="form-control" type="text" placeholder="Input Nomor Undangan" id="nomor_undangan" name="nomor_st">
            <input class="form-control" type="hidden" id="kode" name="kode">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Hari</label>
            <input class="form-control" type="text" placeholder="Input Hari" id="hari" name="hari">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tanggal</label>
            <input class="form-control" type="text" placeholder="Input Tanggal" id="tanggal_notulen" name="tanggal_notulen">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Pukul</label>
            <input class="form-control" type="text" placeholder="Input Pukul" id="pukul" name="pukul">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Tempat</label>
            <input class="form-control" type="text" placeholder="Input Tempat" id="tempat" name="tempat">
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="wizard-simple-lastname">Pemimpin Rapat</label>
            <input class="form-control" type="text" placeholder="Input Hal" id="rapat" name="rapat">
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Peserta Rapat</label>
            <input class="form-control" type="text" placeholder="Input Hal" id="peserta" name="peserta">
        </div>
    </div>
</div>
<div class="col-12">
    <div class="col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="example-textarea-input">Topik Bahasan</label>
            </div>
            <textarea class="form-control" placeholder="Input Topik Bahasan" id="topik" name="topik" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="example-textarea-input">Tanggapan dan Diskusi</label>
            <textarea class="form-control" placeholder="Input Tanggapan dan Diskusi" id="tanggapan_diskusi" name="tanggapan_diskusi" rows="4"></textarea>
        </div> 
        <div class="form-group">
            <label for="example-textarea-input">Keputusan Pimpinan</label>
            <textarea class="form-control" placeholder="Input Keputusan Pimpinan" id="keputusan" name="keputusan" rows="4"></textarea>
        </div> 
        <div class="form-group">
            <label for="example-textarea-input">Kesimpulan</label>
            <textarea class="form-control" placeholder="Input Keismpulan" id="kesimpuan" name="kesimpuan" rows="4"></textarea>
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