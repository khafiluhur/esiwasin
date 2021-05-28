<form action="{{ route('notulensi.dokumentasi') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Notulen</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
            <select class="custom-select" id="pkpt" name="pkpt">
                <option value="">Pilih Penyerapan</option>
                @foreach($pkpt_notulensi as $u)
                <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Nomor undangan rapat</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_undangan" name="nomor" placeholder="Nomor Undangan Rapat" value="{{ old('nomor') }}">
        </div>
        <div class="form-group">
            <label>Hari</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="hari" name="hari" placeholder="Hari" value="{{ old('hari') }}">
        </div>
        <div class="form-group">
            <label>Tanggal</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="tanggal" name="tanggal" placeholder="Tanggal" value="{{ old('tanggal') }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{rand()}}">
        </div>   
        <div class="form-group">
            <label>Pukul</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="pukul" name="pukul" placeholder="Pukul" value="{{ old('pukul') }}">
        </div>   
        <div class="form-group">
            <label>Tempat</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat" value="{{ old('tempat') }}">
        </div>   
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label>Pimpinan Rapat</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="pimpinan" name="pimpinan" placeholder="Pimpinan" value="{{ old('pimpinan') }}">
        </div>  
        <div class="form-group">
            <label for="nomor_st">Peserta Reapat</label><span class="text-danger">*</span>
            <div class="input-group custom-file hdtuto control-group lst increment" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="peserta" name="peserta[]" placeholder="Peserta" value="{{ old('peserta') }}">
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-success" id="add_peserta" type="button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="clone input-group custom-file hdtuto control-group lst" id="form_peserta" style="margin-top:10px" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="peserta" name="peserta[]" placeholder="Peserta" value="{{ old('peserta') }}">
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
            <label for="example-textarea-input">Topik Bahasan</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <textarea class="form-control" id="catatan_notulen" name="catatan" rows="4" placeholder="Topik Bahasan"></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="example-textarea-input">Keputusan</label><span class="text-danger">*</span>
            <textarea class="form-control" placeholder="Input Lampiran" id="lampiran" name="lampiran" rows="4"></textarea>
        </div> 
        <div class="form-group mt-3">
            <label for="example-textarea-input">Kesimpulan</label><span class="text-danger">*</span>
            <textarea class="form-control" placeholder="Input Kesimpulan" id="kesimpualan" name="kesimpualan" rows="4"></textarea>
        </div> 
    </div>
</div>  

<div class="block-header block-header-default">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="submit" class="btn btn-sm btn-success" name="kirim" value="kirim">
            Simpan
        </button>
    </div>
</div>
</form>