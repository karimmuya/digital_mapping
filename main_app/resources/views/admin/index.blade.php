@extends('layouts.admin_app')

@section('content')
    <section>
        <div class="row animated zoomIn">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card hoverable">
                    <div class="row mt-3">
                        <div class="col-md-5 col-5 text-left pl-4">
                            <a type="button" class="btn-floating btn-lg primary-color ml-4"><i class="far fa-location"
                                    aria-hidden="true"></i></a>
                        </div>

                        <div class="col-md-7 col-7 text-right pr-5">
                            <h5 class="ml-4 mt-4 mb-2 font-weight-bold">{{ count($lands) }}</h5>
                            <p class="font-small grey-text">New locations</p>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-7 col-7 text-left pl-4">
                            <p class="font-small font-up ml-4 font-weight-bold">Total locations</p>
                        </div>
                        <div class="col-md-5 col-5 text-right pr-5">
                            <p class="font-small grey-text">{{ count($lands) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card hoverable">
                    <div class="row mt-3">
                        <div class="col-md-5 col-5 text-left pl-4">
                            <a type="button" class="btn-floating btn-lg warning-color ml-4"><i class="fas fa-user"
                                    aria-hidden="true"></i></a>
                        </div>

                        <div class="col-md-7 col-7 text-right pr-5">
                            <h5 class="ml-4 mt-4 mb-2 font-weight-bold">{{ count($users) }}</h5>
                            <p class="font-small grey-text">New users</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-7 col-7 text-left pl-4">
                            <p class="font-small font-up ml-4 font-weight-bold">Total users</p>
                        </div>
                        <div class="col-md-5 col-5 text-right pr-5">
                            <p class="font-small grey-text">{{ count($users) }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-4 col-md-6 mb-4 ">
                <div class="card hoverable ">
                    <div class="row mt-3">
                        <div class="col-md-5 col-5 text-left pl-4">
                            <a type="button" class="btn-floating btn-lg light-blue lighten-1 ml-4"><i
                                    class="fas fa-dollar-sign" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-md-7 col-7 text-right pr-5">
                            <h5 class="ml-4 mt-4 mb-2 font-weight-bold">{{ count($portions) }} </h5>
                            <p class="font-small grey-text">New portions</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-7 col-7 text-left pl-4">
                            <p class="font-small font-up ml-4 font-weight-bold">Total portions</p>
                        </div>
                        <div class="col-md-5 col-5 text-right pr-5">
                            <p class="font-small grey-text">{{ count($portions) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <canvas id="myChart" class="mx-auto mt-3 mb-3 col-md-9 p-3"></canvas>

            <script>
                var data = {!! json_encode($data) !!};

                var xData = data.map(function(item) {
                    return item.x;
                });

                var yData = data.map(function(item) {
                    return item.y;
                });

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: xData,
                        datasets: [{
                            label: 'Payments',
                            data: yData,
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgb(75, 192, 192)',
                            fill: null
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                type: 'linear',
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>


        </div>
    </section>
@endsection
