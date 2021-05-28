@extends('layouts.app')

@section('style')
@endsection

@section('content')
<main id="main-container">
    @if(Auth::user()->level == 8)
    <div class="content content-narrow">
        <div class="row">
            <div class="col-lg-12">
                <div class="block block-rounded block-mode-loading-oneui">
                    
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="content content-narrow">
        <div class="row">
            @if($permission->penyerapan == 1)
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    
                </div>
            </div>
            @else
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <a href="{{url('/penyerapan/')}}" data-toggle="tooltip" class="font-w600" data-placement="left" title="Edit">
                            <h3 class="block-title">Penyerapan</h3>
                        </a>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="py-3">
                            <canvas id="canvas" class=""></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($permission->penugasan == 1)
            <div class="col-lg-6">
                <div class="block block-mode-loading-oneui">
                
                </div>
            </div>
            @else
            <div class="col-lg-6">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Penugasan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="">Level</th>
                                    <th style="width: 80px;">Jumlah</th>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">Total Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penugasan as $u)
                                <tr>
                                    <td class="text-center font-size-sm">{{ $u->nama }}</td>
                                    <td class="d-none d-sm-table-cell font-size-sm">{{ $u->level }}</td>
                                    <td class="font-w600 font-size-sm">0</td>
                                    <td class="d-none d-sm-table-cell font-size-sm">0</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</main>    
@endsection

@section('script')
<script>
    var year = <?php echo $year; ?>;
    var user = <?php echo $user; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'User',
            backgroundColor: "pink",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["SEN", "SEL", "RAB", "KAM", "JUM", "SAB", "MIN"],
                datasets: [
                    {
                        label: "Minggu ini",
                        fill: !0,
                        borderWidth: 1,
                        backgroundColor: "rgba(220,220,220,.3)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        data: [30, 32, 40, 45, 43, 38, 55],
                    },
                    {
                        label: "Minggu Lalu",
                        fill: !0,
                        borderWidth: 1,
                        backgroundColor: "rgba(214, 0, 17, .3)",
                        borderColor: "rgba(214, 0, 17, 1)",
                        pointBackgroundColor: "rgba(214, 0, 17, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(214, 0, 17, 1)",
                        data: [15, 16, 20, 25, 23, 25, 32],
                    },
                ],
            },
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };
</script>

<script src="{{asset('/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('/js/pages/be_comp_charts.min.js')}}"></script>
<script src="{{asset('/js/pages/be_pages_dashboard.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>

<script src="{{asset('/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection
