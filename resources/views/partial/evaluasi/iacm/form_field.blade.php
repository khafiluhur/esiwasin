<form action="{{ route('iacm.evaluasi') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<h3 style="text-align: center">Evaluasi IACM</h3>

<div class="col-12">
    <div class="col-6 float-left">
        <div class="form-group">
            <label>Ketua Tim</label><span class="text-danger">*</span>
            <select class="custom-select" id="ketua" name="ketua">
                <option value="0">Pilih Nama Ketua Tim</option>
                @foreach($anggota as $u)
                <option value="{{ $u->id }}" {{ ( $u->id == $data4->ketua ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label><span class="text-danger">*</span>
            <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{ $data4->nomor_st }}">
            <input class="form-control" type="hidden" id="id" name="id" value="{{ $data4->id }}">
        </div>
    </div>
    <div class="col-6 float-right">
        <div class="form-group">
            <label for="tanggal_audit">Tanggal Evaluasi</label><span class="text-danger">*</span>
            <div class="">
                <div class="form-group">
                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="tanggal_audit_from" name="tanggal_audit_from" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data4->tanggal_evaluasi_from }}">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">
                                s/d
                            </span>
                        </div>
                        <input type="text" class="form-control" id="tanggal_audit_to" name="tanggal_audit_to" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ $data4->tanggal_evaluasi_to }}">
                    </div>
                </div>    
            </div>
        </div>
        <div class="">
            <div class="form-group">
                <label>Kertas Kerja</label><span class="text-danger">*</span>
                @foreach($file4 as $u)
                <div class="col-10 float-left pl-0 pr-0 input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="{{ $u->filename }}"  aria-describedby="basic-addon2" disabled>
                    <div class="input-group-append">
                        <a href="{{ route('evaluasi.iacm.download', ['file' => $u->filename ]) }}" class="input-group-text" id="basic-addon2"><i class="fas fa-download"></i></a>
                    </div>
                </div>
                <div class="input-group-btn col-2 float-left"> 
                    <a href="{{ route('delete.iacm', ['id' => $u->id ]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <input class="form-control" type="hidden" id="kode" name="kode" value="{{ $u->kode_evaluasi_iacm }}">
                </div> 
                @endforeach
                <div class="input-group custom-file hdtuto control-group lst increment" >
                    <div class="col-10 float-left">
                        <input type="file" id="kertas_kerja" name="kertas_kerja[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('kertas_kerja') }}" multiple="multiple">
                        <label class="custom-file-label" for="kertas_kerja">Dokumen</label>
                    </div>
                    <div class="input-group-btn col-2 float-left"> 
                        <button class="btn btn-success" id="add_kertas_iacm" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="clone input-group custom-file hdtuto control-group lst" id="upload_kertas_iacm" style="margin-top:10px" >
                    <div class="col-10 float-left">
                        <input type="file" id="kertas_kerja" name="kertas_kerja[]" class="myfrm form-control custom-file-input" data-toggle="custom-file-input" value="{{ old('kertas_kerja') }}" multiple="multiple">
                        <label class="custom-file-label" for="kertas_kerja">Dokumen</label>
                    </div>
                    <div class="input-group-btn col-2 float-left"> 
                        <button class="btn btn-danger" type="button"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group">
        <div class="input-group">
            <label>Temuan</label><span class="text-danger">*</span>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white">
                    Penjelasan
                </span>
            </div> 
            <textarea class="form-control" id="temuan_akibat" name="temuan_akibat" rows="4">{{ $data4->temuan_penjelasan }}</textarea>
        </div>
    </div>
</div>    

<div class="content">
    <label>Komentar</label><span class="text-danger">*</span>
    <div class="form-group">
        <div class="input-group">
            @if($data4->is_status == 1)
            <textarea class="form-control" id="komentar" name="komentar" rows="4" disabled></textarea>
            @else
            <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Input Penjelasan">{{ old('komentar') }}</textarea>
            @endif
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
                            <td class="text-center">{{ $data4->users_pembuat }}</td>
                            <td class="font-w600 font-size-sm">{{ $data4->status_pembuat }}</td>
                            <td class="font-size-sm">{{ $data4->tanggal_pembuat }}</td>
                            <td>{{ $data4->jam_pembuat }}</td>
                            <td class="text-center">{{ $data4->komentar_pembuat }}</td>
                        </tr>
                        @if($data4->komentar_ketua)
                        <tr>
                            <td class="text-center">{{ $data4->users_ketua }}</td>
                            <td class="font-w600 font-size-sm">{{ $data4->status_ketua }}</td>
                            <td class="font-size-sm">{{ $data4->tanggal_ketua }}</td>
                            <td>{{ $data4->jam_ketua }}</td>
                            <td class="text-center">{{ $data4->komentar_ketua }}</td>
                        </tr>
                        @endif
                        @if($data4->komentar_pt)
                        <tr>
                            <td class="text-center">{{ $data4->users_pt }}</td>
                            <td class="font-w600 font-size-sm">{{ $data4->status_pt }}</td>
                            <td class="font-size-sm">{{ $data4->tanggal_pt }}</td>
                            <td>{{ $data4->jam_pt }}</td>
                            <td class="text-center">{{ $data4->komentar_pt }}</td>
                        </tr>
                        @endif
                         @if($data4->komentar_pm)
                        <tr>
                            <td class="text-center">{{ $data4->users_pm }}</td>
                            <td class="font-w600 font-size-sm">{{ $data4->status_pm }}</td>
                            <td class="font-size-sm">{{ $data4->tanggal_pm }}</td>
                            <td>{{ $data4->jam_pm }}</td>
                            <td class="text-center">{{ $data4->komentar_pm }}</td>
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
        <a href="" class="btn btn-sm btn-secondary" name="simpan" value="simpan">
            Simpan
        </a>
        @if($data4->is_status == 1)
        <button type="submit" class="btn btn-sm btn-primary" disabled>
            Kirim
        </button>
        @else
        <button type="submit" class="btn btn-sm btn-primary" name="kirim" value="kirim">
            Kirim
        </button>
        @endif
    </div>
</div>
</form>