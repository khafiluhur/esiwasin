<form action="{{ route('setuju.kegiatan') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Reviu Kegiatan Anggaran</h3>

<div class="col-12">
    <div class="col-6 float-left">
         @if(Auth::user()->level == 1)
        <div class="form-group">
            <label>Anggota Tim</label>
            <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data2->users_pembuat }}" disabled>
        </div>
        @else
        <div class="form-group">
            <label>Ketua Tim</label>
            <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data2->users_ketua }}" disabled>
        </div>
        @if(Auth::user()->level == 1)
            <div class="form-group">
                <label>Anggota Tim</label>
                @foreach($anggota as $u)
                <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $u->nama }}" disabled>
                @endforeach
            </div>
            @else
            <div class="form-group">
                <label>Anggota Tim</label>
                <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data2->users_pembuat }}" disabled>
            </div>
        @endif
        @endif
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{ $data2->nomor_st }}" disabled>
            <input class="form-control" type="hidden" id="kode2" name="kode" value="{{ $data2->kode }}">
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal Reviu</label>
            <div class="">
                <div class="form-group">
                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data2->tanggal_reviu_from }}" disabled>
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">
                                s/d
                            </span>
                        </div>
                        <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data2->tanggal_reviu_to }}" disabled>
                    </div>
                </div>    
            </div>
        </div>
        <div class="">
            <div class="form-group">
                <label>Kertas Kerja</label>
                @foreach($file2 as $u)
                <div class="col-10 float-left pl-0 pr-0 input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="{{ $u->filename }}"  aria-describedby="basic-addon2" disabled>
                    <div class="input-group-append">
                        <a href="{{ route('review.anggaran.download', ['file' => $u->filename ]) }}" class="input-group-text" id="basic-addon2"><i class="fas fa-download"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="content">
    <label>Temuan</label>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Penjelasan
                </span>
            </div> 
            <textarea class="form-control" id="temuan_sebab" name="temuan_sebab" rows="4" value="" disabled>{{ $data2->temuan_penjelasan_reviu }}</textarea>
        </div>
    </div>
</div>   

<div class="content">
    <label>Komentar</label>
    <div class="form-group">
        <div class="input-group">
            <textarea class="form-control" id="komentar" name="komentar" rows="4"></textarea>
        </div>
    </div>    
</div>

<div class="block">
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
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Tanggal</th>
                            <th style="width: 10%;">Jam</th>
                            <th class="text-center">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $data2->users_pembuat }}</td>
                            <td class="font-w600 font-size-sm">{{ $data2->status_pembuat }}</td>
                            <td class="font-size-sm">{{ $data2->tanggal_pembuat }}</td>
                            <td>{{ $data2->jam_pembuat }}</td>
                            <td class="text-center">{{ $data2->komentar_pembuat }}</td>
                        </tr>
                        @if($data2->komentar_ketua)
                        <tr>
                            <td class="text-center">{{ $data2->users_ketua }}</td>
                            <td class="font-w600 font-size-sm">{{ $data2->status_ketua }}</td>
                            <td class="font-size-sm">{{ $data2->tanggal_ketua }}</td>
                            <td>{{ $data2->jam_ketua }}</td>
                            <td class="text-center">{{ $data2->komentar_ketua }}</td>
                        </tr>
                        @endif
                        @if($data2->komentar_pt)
                        <tr>
                            <td class="text-center">{{ $data2->users_pt }}</td>
                            <td class="font-w600 font-size-sm">{{ $data2->status_pt }}</td>
                            <td class="font-size-sm">{{ $data2->tanggal_pt }}</td>
                            <td>{{ $data2->jam_pt }}</td>
                            <td class="text-center">{{ $data2->komentar_pt }}</td>
                        </tr>
                        @endif
                         @if($data2->komentar_pm)
                        <tr>
                            <td class="text-center">{{ $data2->users_pm }}</td>
                            <td class="font-w600 font-size-sm">{{ $data2->status_pm }}</td>
                            <td class="font-size-sm">{{ $data2->tanggal_pm }}</td>
                            <td>{{ $data2->jam_pm }}</td>
                            <td class="text-center">{{ $data2->komentar_pm }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>

<div class="block-header block-header-default">
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