<form class="text-center" action="{{ route('setuju.konsultasi')}}" method="POST">
@csrf

<h3 style="text-align: center">Konsultasi</h3>

<div id="colum1" style="display: none" class="col-12">
    <div class="col-6">
        <div class="form-group">
            <label>Nama Pegawai</label>
            <select class="custom-select" id="example-select-custom" name="example-select-custom" disabled>
                <option value="0">Pilih Nama Pegawai</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data1->pegawai ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wizard-simple-lastname">Judul Konsultasi</label>
            <input class="form-control" type="text" id="wizard-simple-lastname" name="wizard-simple-lastname" value="{{ $data1->judul }}" disabled>
        </div>
    </div>
</div>

<div id="colum2" style="display: none" class="col-12">
    <div class="col-12">
        <div class="form-group">
            <label for="example-textarea-input">Penjelasan</label>
            <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4" disabled>{{ $data1->penjelasan }}</textarea>
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
                            <td class="text-center">{{ $data1->users_pembuat }}</td>
                            <td class="font-w600 font-size-sm">{{ $data1->status_pembuat }}</td>
                            <td class="font-size-sm">{{ $data1->tanggal_pembuat }}</td>
                            <td>{{ $data1->jam_pembuat }}</td>
                            <td class="text-center">{{ $data1->komentar_pembuat }}</td>
                        </tr>
                        @if($data1->komentar_ketua)
                        <tr>
                            <td class="text-center">{{ $data1->users_ketua }}</td>
                            <td class="font-w600 font-size-sm">{{ $data1->status_ketua }}</td>
                            <td class="font-size-sm">{{ $data1->tanggal_ketua }}</td>
                            <td>{{ $data1->jam_ketua }}</td>
                            <td class="text-center">{{ $data1->komentar_ketua }}</td>
                        </tr>
                        @endif
                        @if($data1->komentar_pt)
                        <tr>
                            <td class="text-center">{{ $data1->users_pt }}</td>
                            <td class="font-w600 font-size-sm">{{ $data1->status_pt }}</td>
                            <td class="font-size-sm">{{ $data1->tanggal_pt }}</td>
                            <td>{{ $data1->jam_pt }}</td>
                            <td class="text-center">{{ $data1->komentar_pt }}</td>
                        </tr>
                        @endif
                         @if($data1->komentar_pm)
                        <tr>
                            <td class="text-center">{{ $data1->users_pm }}</td>
                            <td class="font-w600 font-size-sm">{{ $data1->status_pm }}</td>
                            <td class="font-size-sm">{{ $data1->tanggal_pm }}</td>
                            <td>{{ $data1->jam_pm }}</td>
                            <td class="text-center">{{ $data1->komentar_pm }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>

<div id="colum4" style="display: none" class="block-header block-header-default">
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