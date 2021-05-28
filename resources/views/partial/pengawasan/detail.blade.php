@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
@endsection

@section('content')
<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="js-wizard-simple block">

                <div class="block-content block-content-full tab-content px-md-5" style="min-height: 90%;">

                    <div class="tab-pane active" id="pengawasan" role="tabpanel">
                        <form action="{{ route('pengawasan.download', ['id' => $audit->kode ]) }}" method="GET">
                            {{ csrf_field() }}
                            <h3 style="text-align: center">{{$title}}</h3>

                            @if($audit->jenis == 4 || $audit->jenis == 5)
                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label>Jenis Laporan</label>
                                        <input class="form-control" type="text" id="user_pm" name="user_pm" value="{{$audit->laporan}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="form-group">
                                        <label>Periode Laporan</label>
                                        <input class="form-control" type="text" id="anggota" name="anggota" value="{{$audit->periode}}" disabled>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-12">
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label>Pengendali Mutu</label>
                                        <input class="form-control" type="text" id="user_pm" name="user_pm" value="{{$audit->users_pm}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengendali Teknis</label>
                                        <input class="form-control" type="text" id="user_pt" name="user_pt" value="{{$audit->users_pt}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketua Tim</label>
                                        <input class="form-control" type="text" id="user_ketua" name="user_ketua" value="{{$audit->users_ketua}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Anggota Tim</label>
                                        <input class="form-control" type="text" id="anggota" name="anggota" value="{{$audit->users_anggota}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6 float-right">
                                    <div class="form-group">
                                        <label>Pegawai</label>
                                        <input class="form-control" type="text" id="anggota" name="anggota" value="{{$audit->users_pembuat}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_st">Nomor ST</label>
                                        @if($audit->nomor_st == 0)
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="" disabled>
                                        @else
                                        <input class="form-control" type="text" id="nomor_st" name="nomor_st" value="{{$audit->nomor_st}}" disabled>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Penjelasan</label>
                                        <div class="input-group">
                                        <textarea class="form-control" id="penjelasan" name="penjelasan" rows="4" placeholder="Input Penjelasan" value="" disabled>{{ $audit->penjelasan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="block">
                                <div class="block-header">
                                    <div class="col-12">
                                        <h3 class="block-title">Supervisi</h3>
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
                                                        <td class="text-center">{{ $audit->users_pembuat }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pembuat }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pembuat }}</td>
                                                        <td>{{ $audit->jam_pembuat }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pembuat }}</td>
                                                    </tr>
                                                    @if($audit->komentar_ketua)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_ketua }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_ketua }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_ketua }}</td>
                                                        <td>{{ $audit->jam_ketua }}</td>
                                                        <td class="text-center">{{ $audit->komentar_ketua }}</td>
                                                    </tr>
                                                    @endif
                                                    @if($audit->komentar_pt)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_pt }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pt }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pt }}</td>
                                                        <td>{{ $audit->jam_pt }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pt }}</td>
                                                    </tr>
                                                    @endif
                                                        @if($audit->komentar_pm)
                                                    <tr>
                                                        <td class="text-center">{{ $audit->users_pm }}</td>
                                                        <td class="font-w600 font-size-sm">{{ $audit->status_pm }}</td>
                                                        <td class="font-size-sm">{{ $audit->tanggal_pm }}</td>
                                                        <td>{{ $audit->jam_pm }}</td>
                                                        <td class="text-center">{{ $audit->komentar_pm }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            @endif
                            <div class="block-header block-header-default">
                                <h3 class="block-title"></h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary" name="unduh" value="unduh">
                                        Unduh
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
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function(){
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);
        });
        $("body").on("click",".btn-danger",function(){$(this).parents(".hdtuto control-group lst").remove();
        });
    });
</script>
<script src="{{asset('/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/plugins/jquery-validation/additional-methods.js')}}"></script>

<script src="{{asset('/js/pages/be_forms_wizard.min.js')}}"></script>

<script src="{{asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

<script>jQuery(function(){ One.helpers(['datepicker', 'rangeslider']); });</script>
@endsection