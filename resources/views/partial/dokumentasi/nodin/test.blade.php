<form action="{{ route('nodim.dokumentasi') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Pengajuan NODIN</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Kepada</label><span class="text-danger">*</span>
            <select class="custom-select" id="kepada" name="kepada">
                <option value="">Pilih Nama</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ old('kepada') == $u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label><span class="text-danger">*</span>
            <select class="custom-select" id="dari" name="dari">
                <option value="">Pilih Nama</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ old('dari') == $u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Dasar</label><span class="text-danger">*</span>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <td><input type="text" name="dasar[0]" placeholder="Dasar Nodin" class="form-control" />
                    </td>
                    <td><button name="add" id="dynamic-ar" class="btn btn-success" type="button"><i class="fas fa-plus"></i></button></td>
                </tr>
            </table>
            {{-- <div class="input-group custom-file hdtuto control-group lst increment" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="dasar" name="dasar[]" placeholder="Dasar Nodin">
                </div>  
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-success" id="add_dasar" type="button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="clone input-group custom-file hdtuto control-group lst" id="form_dasar" style="margin-top:10px" >
                <div class="col-10 float-left pl-0">
                    <input class="form-control" type="text" id="dasar" name="dasar[]" placeholder="Dasar Nodin">
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                </div>
            </div> --}}
            
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label>Hal</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="hal" name="hal" placeholder="Hal" value="{{ old('hal') }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{rand()}}">
        </div>  
        <div class="form-group">
            <label for="tanggal_audit">Tanggal</label><span class="text-danger">*</span>
            <input type="text" class="js-datepicker form-control" id="tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Tanggal">
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label for="example-textarea-input">Isi Nodin</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <textarea class="form-control" id="isi_nodim" name="isi_nodim" rows="4" placeholder="Input isi nodin"></textarea>
        </div>
         <div class="form-group mt-3">
            <div class="input-group-prepend input-group">
                <label>Nomor NODIN</label><span class="text-danger">*</span>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text font-w600">
                       ND-
                    </span>
                </div>
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
        <div class="form-group">
            <label for="example-textarea-input">Tembusan</label><span class="text-danger">*</span>
            <textarea class="form-control" placeholder="Input Tembusan" id="tembusan" name="tembusan" rows="4"></textarea>
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
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="dasar[' + i +
            ']" placeholder="Dasar Nodin" class="form-control" /></td><td> <button class="btn btn-danger" type="button"><i class="fas fa-minus remove-input-field"></i></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>