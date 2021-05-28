<form class="text-center" action="{{ route('konsultasi.pengawasan')}}" method="POST">
{{ csrf_field() }}

<h3 style="text-align: center">Konsultasi</h3>

<a id="button-konsultasi" onclick="myFunction()" type="" class="btn btn-sm btn-primary" style="font-size: 30px;margin: 55px 0; color: #FFFFFF">
    Ajukan Konsultasi
</a>

<div id="colum1" style="display: none" class="col-12">
    <div class="col-6">
        <div class="form-group">
            <label>Nama Pegawai</label><span class="text-danger">*</span>
            <select class="custom-select" id="pegawai" name="pegawai">
                <option value="0">Pilih Nama Anggota Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Judul Konsultasi</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="judul" name="judul" placeholder="Input Judul Konsultasi" value="{{ old('judul') }}">
            <input class="form-control" type="hidden" id="kode13" name="kode" value="{{rand()}}">
        </div>
        <div class="form-group">
            <label for="nomor_st">Penyerapan</label><span class="text-danger">*</span>
            <select class="custom-select" id="pkpt" name="pkpt">
                <option value="">Pilih Penyerapan</option>
                @foreach($pkpt_konsultasi as $u)
                <option value="{{ $u->id }}" {{ old('pkpt') == $u->id ? 'selected' : '' }}>{{ $u->kegiatan }} (@currency($u->saldo)) </option>
                @endforeach
            </select>
        </div>
    </div>
 
</div>

<div id="colum2" style="display: none" class="col-12">
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Penjelasan</label><span class="text-danger">*</span>
            <textarea class="form-control" id="penjelasan" name="penjelasan" rows="4" placeholder="Input Penjelasan" value="">{{ old('penjelasan') }}</textarea>
        </div>
    </div> 
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Komentar</label><span class="text-danger">*</span>
            <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Input Komentar">{{ old('komentar') }}</textarea>
        </div>
    </div>    
</div>  
  

<div id="colum3" style="display: none" class="block">
    <div class="block-header">
        <div class="col-12">
            <h3 class="block-title">Progress Approvel</h3>
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

<div id="colum4" style="display: none" class="block-header block-header-default">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="reset" class="btn btn-sm btn-secondary">
            Simpan
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
            Kirim
        </button>
    </div>
</div>
</form>