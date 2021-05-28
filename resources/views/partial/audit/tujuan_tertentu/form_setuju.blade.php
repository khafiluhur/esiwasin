<form action="{{ route('setuju.tujuantertentu') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<h3 style="text-align: center">Audit Tujuan Tertentu</h3>

<div class="col-12">
    <div class="col-6 float-left">
         @if(Auth::user()->level == 1)
        <div class="form-group">
            <label>Anggota Tim</label>
            <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data3->users_ketua }}" disabled>
        </div>
        @else
        <div class="form-group">
            <label>Ketua Tim</label>
            <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data3->users_ketua }}" disabled>
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
                <input class="form-control" type="text" id="created_by" name="created_by" value="{{ $data1->users_pembuat }}" disabled>
            </div>
        @endif
        @endif
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{ $data3->nomor_st }}" disabled>
            <input class="form-control" type="hidden" id="id" name="id" value="{{ $data3->id }}">
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal Audit</label>
            <div class="">
                <div class="form-group">
                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data3->tanggal_audit_from }}" disabled>
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">
                                s/d
                            </span>
                        </div>
                        <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data3->tanggal_audit_to }}" disabled>
                    </div>
                </div>    
            </div>
        </div>
        <div class="">
            <div class="form-group">
                <label>Kertas Kerja</label>
                @foreach($file3 as $u)
                <div class="float-left pl-0 pr-0 input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="{{ $u->filename }}"  aria-describedby="basic-addon2" disabled>
                    <div class="input-group-append">
                        <a href="{{ route('audit.tujuantertentu.download', ['file' => $u->filename ]) }}" class="input-group-text" id="basic-addon2"><i class="fas fa-download"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label>Temuan</label>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Judul
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_judul" name="temuan_judul" value="{{ $data3->temuan_judul }}" disabled>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Kondisi
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_kondisi" name="temuan_kondisi" value="{{ $data3->temuan_kondisi }}" disabled>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Kriteria
                </span>
            </div>
            <input type="text" class="form-control" id="temuan_kriteria" name="temuan_kriteria" value="{{ $data3->temuan_kriteria }}" disabled>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Sebab
                </span>
            </div> 
            <textarea class="form-control" id="temuan_sebab" name="temuan_sebab" rows="4" value="" disabled>{{ $data3->temuan_sebab }}</textarea>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Akibat
                </span>
            </div> 
            <textarea class="form-control" id="temuan_akibat" name="temuan_akibat" rows="4" disabled>{{ $data3->temuan_akibat }}</textarea>
        </div>
    </div>
</div>   

<div class="content">
    <label>Komentar</label>
    <div class="form-group">
        <div class="input-group">
            <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Input Komentar"></textarea>
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