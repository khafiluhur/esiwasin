<form class="text-center" action="{{ route('kordinasi.pengawasan')}}" method="POST">
@csrf

<h3 style="text-align: center">Sosialisasi</h3>

<div id="columkoordinasi1" class="col-12">
    <div class="col-6">
        <div class="form-group">
            <label>Nama Pegawai</label>
            <select class="custom-select" id="pegawai" name="pegawai">
                <option value="0">Pilih Nama Pegawai</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data3->pegawai ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Judul Sosialisasi</label>
            <input class="form-control" type="text" id="judul" name="judul" value="{{ $data3->judul }}">
            <input class="form-control" type="hidden" id="kode" name="kode" value="{{ $data3->kode }}">
        </div>
    </div>
</div>

<div id="columkoordinasi2" class="col-12">
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Penjelasan</label>
            <textarea class="form-control" id="penjelasan" name="penjelasan" rows="4">{{ $data3->penjelasan }}</textarea>
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
                            <td class="text-center">{{ $data3->users_pembuat }}</td>
                            <td class="font-w600 font-size-sm">{{ $data3->status_pembuat }}</td>
                            <td class="font-size-sm">{{ $data3->tanggal_pembuat }}</td>
                            <td>{{ $data3->jam_pembuat }}</td>
                            <td class="text-center">{{ $data3->komentar_pembuat }}</td>
                        </tr>
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
        <button type="reset" class="btn btn-sm btn-secondary">
            Simpan
        </button>
        @if($data3->is_status == 1)
        <button type="submit" class="btn btn-sm btn-primary" disabled>
            Kirim
        </button>
        @else
        <button type="submit" class="btn btn-sm btn-primary">
            Kirim
        </button>
        @endif
    </div>
</div>
</form>