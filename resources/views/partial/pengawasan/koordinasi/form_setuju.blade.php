<form class="text-center" action="{{ route('setuju.kordinasi')}}" method="POST">
{{ csrf_field() }}

<h3 style="text-align: center">Sosialisasi</h3>

<div id="colum1" class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Nama Pegawai</label>
            <select class="custom-select" id="pegawai" name="pegawai" disabled>
                <option value="0">Pilih Nama Pegawai</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data3->pegawai ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Judul Koordinasi</label>
            <input class="form-control" type="text" id="wizard-simple-lastname" name="wizard-simple-lastname" value="{{ $data3->judul }}" disabled>
        </div>
    </div>
    @if(Auth::user()->level == 1 )
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Ketua Tim</label><span class="text-danger">*</span>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Ketua Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data3->id_anggota ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{$data3->nomor_st}}">
        </div> 
    </div>
    @elseif(Auth::user()->level == 3)
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Anggota Tim</label><span class="text-danger">*</span>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Anggota Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data3->id_anggota ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{$data3->nomor_st}}">
        </div> 
    </div>
    @elseif(Auth::user()->level == 4)
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Pelaksana Teknis</label><span class="text-danger">*</span>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Pelaksana Tekni</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data3->id_pt ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{$data3->nomor_st}}">
        </div> 
    </div>
    @else
    @if($data3->nomor_st)
        <div class="col-6">
            <div class="form-group">
                <label>Ketua Tim</label><span class="text-danger">*</span>
                <select class="custom-select" id="ketua" name="ketua">
                    <option value="0">Pilih Nama Ketua Tim</option>
                    @foreach($anggota as $u)
                    <option value="{{ $u->id }}" {{ ( $u->id == $data3->id_users_ketua ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
                <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas" value="{{$data3->nomor_st}}">
            </div> 
        </div>
        @else
        <div class="col-6">
            <div class="form-group">
                <label>Ketua Tim</label><span class="text-danger">*</span>
                <select class="custom-select" id="ketua" name="ketua">
                    <option value="0">Pilih Nama Ketua Tim</option>
                    @foreach($ketua as $u)
                    <option value="{{ $u->id }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
                <input class="form-control" type="text" id="nomor_st" name="nomor_st" placeholder="Input Nomor Surat Tugas">
            </div> 
        </div>
        @endif
    @endif
</div>

<div id="columkoordinasi2" class="col-12">
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Penjelasan</label>
            <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4" disabled>{{ $data3->penjelasan }}</textarea>
            <input type="hidden" id="kode" name="kode" value="{{$data3->id}}">
        </div>
    </div>  
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Komentar</label><span class="text-danger">*</span>
            <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Input Komentar">{{ old('komentar') }}</textarea>
        </div>
    </div>   
</div>    

<div id="columkoordinasi3" class="block">
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
                            <td class="text-center">{{ $data3->users_pembuat }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_pembuat }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_pembuat }}</td>
                            <td>{{ $data3->jam_pembuat }}</td>
                            <td class="text-center">{{ $data3->komentar_pembuat }}</td>
                        </tr>
                         @if($data3->komentar_anggota)
                        <tr>
                            <td class="text-center">{{ $data3->users_anggota }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_anggota }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_anggota }}</td>
                            <td>{{ $data3->jam_anggota }}</td>
                            <td class="text-center">{{ $data3->komentar_anggota }}</td>
                        </tr>
                        @endif
                        @if($data3->komentar_ketua)
                        <tr>
                            <td class="text-center">{{ $data3->users_ketua }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_ketua }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_ketua }}</td>
                            <td>{{ $data3->jam_ketua }}</td>
                            <td class="text-center">{{ $data3->komentar_ketua }}</td>
                        </tr>
                        @endif
                        @if($data3->komentar_pt)
                        <tr>
                            <td class="text-center">{{ $data3->users_pt }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_pt }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_pt }}</td>
                            <td>{{ $data3->jam_pt }}</td>
                            <td class="text-center">{{ $data3->komentar_pt }}</td>
                        </tr>
                        @endif
                         @if($data3->komentar_pm)
                        <tr>
                            <td class="text-center">{{ $data3->users_pm }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_pm }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_pm }}</td>
                            <td>{{ $data3->jam_pm }}</td>
                            <td class="text-center">{{ $data3->komentar_pm }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>

<div id="columkoordinasi4" class="block-header block-header-default">
    <h3 class="block-title"></h3>
    <div class="block-options">
        <button type="submit" class="btn btn-sm btn-danger" name="kembali" value="kembali">
            Kembali
        </button>
        <button type="submit" class="btn btn-sm btn-primary" name="kirim" value="kirim">
            Setuju
        </button>
    </div>
</div>
</form>