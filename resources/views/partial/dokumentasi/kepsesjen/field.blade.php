<form action="{{ route('kepseajen.dokumentasi') }}" method="POST">
{{ csrf_field() }}

<h3 style="text-align: center">Pengajuan Kepsesjen</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Kepada</label><span class="text-danger">*</span>
            <select class="custom-select" id="kepada" name="kepada">
                <option value="">Pilih Nama</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data2->kepada ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label><span class="text-danger">*</span>
            <select class="custom-select" id="dari" name="dari">
                <option value="">Pilih Nama</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data2->dari ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tentang</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="tentang" name="tentang" placeholder="Input Tentang" value="{{ $data2->tentang }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{ $data2->kode }}">
        </div>   
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal</label><span class="text-danger">*</span>
            <div class="input-group custom-file hdtuto control-group lst" id="upload_kertas_keuangan" style="margin-top:10px" >
                <input type="text" class="js-datepicker form-control" id="tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Tanggal" value="{{ $data2->tanggal }}">
            </div>
        </div>
        <div class="form-group">
            <label>Pejabat</label><span class="text-danger">*</span>
            <select class="custom-select" id="pejabat" name="pejabat">
                <option value="">Pilih Pejabat</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data2->pejabat ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label><span class="text-danger">*</span>
            <select class="custom-select" id="jabatan" name="jabatan">
                <option value="">Pilih Jabatan</option>
                @foreach($jabatan as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data2->jabatan ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div> 
        <div class="form-group">
            <div class="form-group">
                <label for="nomor_st">Landasan Hukum</label><span class="text-danger">*</span>
            </div>
            @foreach($file2 as $u)
                <div class="col-10 float-left pl-0 pr-0 input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="{{ $u->landasan_hukum }}"  aria-describedby="basic-addon2" disabled>
                </div>
            @endforeach
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <td><input type="text" name="landasan[0]" placeholder="Landasan Hukum" class="form-control" />
                    </td>
                    <td><button name="add" id="dynamic-ar" class="btn btn-success" type="button"><i class="fas fa-plus"></i></button></td>
                </tr>
            </table>
            {{-- <div class="input-group custom-file hdtuto control-group lst increment" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="landasan" name="landasan[]" placeholder="Landasan Hukum" value="{{ old('dasar') }}">
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-success" id="add_landasan" type="button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="clone input-group custom-file hdtuto control-group lst" id="form_landasan" style="margin-top:10px" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="landasan" name="landasan[]" placeholder="Landasan Hukum" value="{{ old('dasar') }}">
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                </div>
            </div> --}}
        </div>  
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label for="example-textarea-input">Isi Per/Kepsesjen</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <textarea class="form-control" id="catatan" name="catatan" rows="4" placeholder="Input Isi Nodin">{{ $data2->catatan }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="example-textarea-input">Lampiran</label><span class="text-danger">*</span>
            <textarea class="form-control" placeholder="Input Lampiran" id="lampiran" name="lampiran" rows="4">{{ $data2->lampiran }}</textarea>
        </div> 
        <div class="form-group mt-3">
            <div class="input-group-prepend input-group">
                <label>Nomor Kep/Per</label><span class="text-danger">*</span>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text font-w600">
                       Persesjen
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Nomor" id="nomor_kepsesjen" name="nomor_kepsesjen" value="{{ $data2->nomor }}">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Tahun" id="tahun_kepsesjen" name="tahun_kepsesjen" value="{{ $data2->tahun }}">
            </div>    
        </div> 
    </div>
</div>  

<div class="block-header block-header-default">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="submit" class="btn btn-sm btn-success" name="kirim" value="kirim">
            Simpan
        </button>
        <button type="submit" class="btn btn-sm btn-primary" name="unduh" value="unduh">
            Unduh
        </button>
    </div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="landasan[' + i +
            ']" placeholder="Landasan Hukum" class="form-control" /></td><td> <button class="btn btn-danger" type="button"><i class="fas fa-minus remove-input-field"></i></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>