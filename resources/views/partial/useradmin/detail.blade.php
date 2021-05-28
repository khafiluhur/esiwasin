@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
            </h1>
        </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                    </li>
                </ul>

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="audit_keuangan" role="tabpanel">
                        <form action="{{ route('ubah.useradmin', ['id' => $users->id ]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <h3 style="text-align: center">Users</h3>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$users->nama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">NIP/NRP</label>
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$users->nip}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">Group</label>
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$users->group}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">Jabatan</label>
                                        <select class="custom-select" id="jabatan" name="jabatan" disabled>
                                            <option value="">Pilih Jabatan</option>
                                            @foreach($jabatan as $u)
                                            <option value="{{ $u->id }}" {{ ( $u->id == $users->jabatan ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nomor_st">Aktif Akun</label>
                                        <select class="custom-select" id="is_active" name="is_active">
                                            <option value="">Pilih Aktif</option>
                                            <option value="1" {{ ( $users->is_active == 1 ) ? 'selected' : '' }}>AKTIF</option>
                                            <option value="0" {{ ( $users->is_active == 0 ) ? 'selected' : '' }}>TIDAK AKTIF</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">Level</label>
                                        <select class="custom-select" id="level" name="level">
                                            <option value="">Pilih Level</option>
                                            @foreach($level as $u)
                                            <option value="{{ $u->id }}" {{ ( $u->id == $users->level ) ? 'selected' : '' }}>{{ $u->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="">
                                <div class="col-12">
                                    <div class="col-12 text-center">
                                        <h3 class="">Dashboard</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Penyerapan</label>
                                            <select class="custom-select" id="penyerapan" name="penyerapan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->penyerapan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Penugasan</label>
                                            <select class="custom-select" id="penugasan" name="penugasan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->penugasan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12 text-center">
                                        <h3 class="">User Admin</h3>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>User Admin</label>
                                            <select class="custom-select" id="user_admin" name="user_admin">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->user_admin ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                </div>    
                            </div>  

                            <div>
                                <div class="col-12">
                                    <div class="col-12 text-center">
                                        <h3 class="">Penugasan</h3>
                                        <h4 class="">Audit</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Audit Keuangan</label>
                                            <select class="custom-select" id="audit_keuangan" name="audit_keuangan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->audit_keuangan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Audit Kinerja</label>
                                            <select class="custom-select" id="audit_kinerja" name="audit_kinerja">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->audit_kinerja ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Audit Tujuan Tertentu</label>
                                            <select class="custom-select" id="audit_tujuan_tertentu" name="audit_tujuan_tertentu">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->audit_tujuan_tertentu ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Reviu</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Reviu Laporan Keuangan</label>
                                            <select class="custom-select" id="reviu_laporan_keuangan" name="reviu_laporan_keuangan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->reviu_laporan_keuangan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Reviu Kegiatan Anggaran</label>
                                            <select class="custom-select" id="reviu_anggaran_kegiatan" name="reviu_anggaran_kegiatan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->reviu_anggaran_kegiatan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Reviu LAKIP</label>
                                            <select class="custom-select" id="reviu_lakip" name="reviu_lakip">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->reviu_lakip ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Reviu RKBMN</label>
                                            <select class="custom-select" id="reviu_rkbmn" name="reviu_rkbmn">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->reviu_rkbmn ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Evaluasi</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Evaluasi SAKIP</label>
                                            <select class="custom-select" id="evaluasi_sakip" name="evaluasi_sakip">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->evaluasi_sakip ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Evaluasi RB</label>
                                            <select class="custom-select" id="evaluasi_rb" name="evaluasi_rb">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->evaluasi_rb ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Maturitas SPIP</label>
                                            <select class="custom-select" id="evaluasi_maturitas_spip" name="evaluasi_maturitas_spip">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->evaluasi_maturitas_spip ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>IACM</label>
                                            <select class="custom-select" id="evaluasi_iacm" name="evaluasi_iacm">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->evaluasi_iacm ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Pemantauan</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Pemantauan TL BPK</label>
                                            <select class="custom-select" id="pemantauan_tl_bpk" name="pemantauan_tl_bpk">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pemantauan_tl_bpk ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Pemantauan TL LHA</label>
                                            <select class="custom-select" id="pemantauan_tl_lha" name="pemantauan_tl_lha">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pemantauan_tl_lha ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Pemantauan SPIP</label>
                                            <select class="custom-select" id="pemantauan_spip" name="pemantauan_spip">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pemantauan_spip ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Pemantauan LHKASN</label>
                                            <select class="custom-select" id="pemantauan_lhkasn" name="pemantauan_lhkasn">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pemantauan_lhkasn ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Pengawasan Lainnya</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Kosultasi</label>
                                            <select class="custom-select" id="pengawasan_konsultasi" name="pengawasan_konsultasi">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pengawasan_konsultasi ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Sosialisasi</label>
                                            <select class="custom-select" id="pengawasan_sosialisasi" name="pengawasan_sosialisasi">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pengawasan_sosialisasi ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Asistensi</label>
                                            <select class="custom-select" id="pengawasan_asistensi" name="pengawasan_asistensi">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pengawasan_asistensi ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>RBZI</label>
                                            <select class="custom-select" id="pengawasan_rbzi" name="pengawasan_rbzi">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pengawasan_rbzi ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>SAKIP</label>
                                            <select class="custom-select" id="pengawasan_sakip" name="pengawasan_sakip">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->pengawasan_sakip ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Dokumentasi</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Pengajuan Nodin</label>
                                            <select class="custom-select" id="dokumentasi_pengajuan_nodin" name="dokumentasi_pengajuan_nodin">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->dokumentasi_pengajuan_nodin ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Pengajuan Kep/Persesjen</label>
                                            <select class="custom-select" id="dokumentasi_pengajuan_kepsesjen" name="dokumentasi_pengajuan_kepsesjen">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->dokumentasi_pengajuan_kepsesjen ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Input PKPT</label>
                                            <select class="custom-select" id="dokumentasi_input_pkpt" name="dokumentasi_input_pkpt">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->dokumentasi_input_pkpt ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Input Notulen</label>
                                            <select class="custom-select" id="dokumentasi_input_notulen" name="dokumentasi_input_notulen">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->dokumentasi_input_notulen ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="">Laporan</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Laporan Hasil Audit</label>
                                            <select class="custom-select" id="laporan_hasil_audit" name="laporan_hasil_audit">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_audit ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Laporan Hasil Reviu</label>
                                            <select class="custom-select" id="laporan_hasil_reviu" name="laporan_hasil_reviu">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_reviu ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Laporan Hasil Evaluasi</label>
                                            <select class="custom-select" id="laporan_hasil_evaluasi" name="laporan_hasil_evaluasi">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_evaluasi ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Laporan Hasil Pemantauan</label>
                                            <select class="custom-select" id="laporan_hasil_pemantauan" name="laporan_hasil_pemantauan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_pemantauan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Laporan Hasil Pengawasan Lainnya</label>
                                            <select class="custom-select" id="laporan_hasil_pengawasan" name="laporan_hasil_pengawasan">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_pengawasan ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col">
                                            <label>Laporan Notulen</label>
                                            <select class="custom-select" id="laporan_hasil_notulen" name="laporan_hasil_notulen">
                                                @foreach($submenu as $u)
                                                <option value="{{ $u->id }}" {{ ( $u->id == $menu->laporan_hasil_notulen ) ? 'selected' : '' }}>{{$u->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                </div> 
                            </div>

                            <div class="block-header block-header-default col-12">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary" name="kirim" value="kirim">
                                        Save
                                    </button>
                                </div>
                            </div>
                            </form> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- <script>

    $('#level').on('change', function () {
    if(this.value == 1) {
        $("#peng-tek").removeClass("d-none");
        $("#peng-mutu").removeClass("d-none");
        $("#ket-an").addClass("d-none");
    } else if (this.value == 2) {
        $("#peng-tek").addClass("d-none");
        $("#peng-mutu").addClass("d-none");
        $("#ket-an").removeClass("d-none");
    } else {
        $("#peng-tek").addClass("d-none");
        $("#peng-mutu").addClass("d-none");
        $("#ket-an").addClass("d-none");
    }
    });
</script> -->
<script src="{{asset('/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/additional-methods.js')}}"></script>

<script src="{{asset('/js/pages/be_forms_wizard.min.js')}}"></script>

<script src="{{asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['datepicker', 'rangeslider']); });</script>
@endsection