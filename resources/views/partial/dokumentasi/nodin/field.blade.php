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
                <option value="{{ $u->id }}" {{ ( $u->id == $data1->kepada ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Dari</label><span class="text-danger">*</span>
            <select class="custom-select" id="dari" name="dari">
                <option value="">Pilih Nama</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data1->dari ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="nomor_st">Dasar</label><span class="text-danger">*</span>
            </div>
            @foreach($file1 as $u)
                <div class="col-10 float-left pl-0 pr-0 input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="{{ $u->dasar }}"  aria-describedby="basic-addon2" disabled>
                </div>
            @endforeach
            <div class="input-group custom-file hdtuto control-group lst increment" >
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
            </div>
            
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label>Hal</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="hal" name="hal" placeholder="Hal" value="{{ $data1->hal }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{ $data1->kode }}">
        </div>  
        <div class="form-group">
            <label for="tanggal_audit">Tanggal</label><span class="text-danger">*</span>
            <input type="text" class="js-datepicker form-control" id="tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Tanggal" value="{{ $data1->tanggal }}">
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label for="example-textarea-input">Isi Nodin</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <textarea class="form-control" id="isi_nodim" name="isi_nodim" rows="4" placeholder="Input isi nodin">{{ $data1->isi_nodim }}</textarea>
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
                <input class="form-control" type="text" placeholder="Nomor" id="nomor" name="nomor" value="{{ $data1->nomor }}">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Kode Arsip" id="kode_arsip" name="kode_arsip" value="{{ $data1->kode_arsip }}">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        /
                    </span>
                </div>
                <input class="form-control" type="text" placeholder="Tahun" id="tahun" name="tahun" value="{{ $data1->tahun }}">
            </div>    
        </div> 
        <div class="form-group">
            <label for="example-textarea-input">Tembusan</label><span class="text-danger">*</span>
            <textarea class="form-control" placeholder="Input Tembusan" id="tembusan" name="tembusan" rows="4">{{ $data1->tembusan }}</textarea>
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