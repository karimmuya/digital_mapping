@extends('layouts.app')

@section('content')

    <div class="m-5 pt-3">

        <section class="pb-5 animated fadeIn">
            @include('layouts.alerts')
            @foreach ($land as $land)
                <div class="card mt-5 hoverable">
                    <div class="m-3">
                        <div class="col-lg-12">

                            <div class="dark-grey-text pt-3 pl-4 ">
                                <div>
                                    <h2 class="card-title font-weight-bold pt-2 "><strong>{{ $land->name }}</strong></h2>
                                    <p class="pb-4 pt-4">{{ $land->descr }}</p>
                                    <div class="row">


                                        <div class="col-md-3">
                                            <p>Region: <strong>{{ $land->region }}</strong></p>
                                            <p>District: <strong>{{ $land->district }}</strong></p>
                                            <p>Usage: <strong>Miradi</strong></p>
                                            <p>Price TZS: <strong>{{ $land->pricepersqm }}</strong></p>

                                        </div>
                                        <div class="col">

                                            <p>Starting price TZS: <strong>{{ $land->stprice }}</strong></p>
                                            <p>Payment within months: <strong>{{ $land->pymnt_season }}</strong></p>
                                            <p>For more info, contact us at: <strong> {{ $land->phone }}</strong></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mt-5 mb-4">
                    <div class="">
                        <div class="">

                            <ul class="nav md-tabs nav-justified grey lighten-3 mx-0" role="tablist">

                                <li class="nav-item">

                                    <a class="nav-link active dark-grey-text font-weight-bold" data-toggle="tab"
                                        href="#panel1" role="tab"> Digital Map</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link dark-grey-text font-weight-bold" data-toggle="tab" href="#panel2"
                                        role="tab">
                                        Google Map</a>
                                </li>

                                <li class="nav-item">

                                    <a class="nav-link dark-grey-text font-weight-bold" data-toggle="tab" href="#panel3"
                                        role="tab">
                                        </i>Gallery </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            @endforeach

            <div class="tab-content p-0 m-0 ">
                <div class="tab-pane fade in show active " id="panel1" role="tabpanel">
                    <br>
                    <div class="card mt-2 hoverable">
                        <div class="m-3">
                            <div class="col-lg-12 m-auto">
                                <div class="m-3">
                                    <div class="m-1 mb-4">
                                        <div class="row ">
                                            <div>

                                                <h5 class="text text-"><strong>{{ $land->name }}</strong></h5>

                                            </div>
                                            <div class="ml-auto ">
                                                <span class="badge badge-pill badge-primary">Reserved</span>
                                                <span class="badge badge-pill badge-danger">Taken</span>
                                                <span class="badge badge-pill badge-dark">Available</span>
                                            </div>
                                        </div>
                                    </div>


                                    @if (count($portions) > 0)
                                        <div class="mx-auto">
                                            <svg id="svg" version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 10 2376.000000 1144.000000" preserveAspectRatio="xMidYMid meet">
                                                <g transform="translate(0.000000,1144.000000) scale(0.100000,-0.100000)">
                                                    {{-- @foreach ($portions as $portions)
                                                        {!! $portions->vector !!}
                                                    @endforeach --}}



                                                    @foreach ($portions as $portions)
                                                        @php
                                                            
                                                            $pattern = '/<path[^>]*\bd="(.*?)".*<\/path>/s';
                                                            preg_match($pattern, $portions->vector, $matches);
                                                            
                                                            if (isset($matches[1])) {
                                                                $dAttribute = $matches[1];
                                                            } else {
                                                                $dAttribute = '';
                                                            }
                                                            
                                                        @endphp
                                                        <path class="path-class" d="{{ $dAttribute }}"
                                                            style="fill: {{ $portions->fill }};" id={{ $portions->id }}>
                                                        </path>
                                                    @endforeach

                                                </g>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="panel2" role="tabpanel">
                    <br>
                    <div class="card hoverable">
                        <br>
                        <div class="m-3">
                            <div class="col-lg-12">

                                <div class="dark-grey-text d-flex  align-items-center pt-3 pl-4 ">
                                    <div>
                                        <h2 class="card-title font-weight-bold pt-2 pb-2 "><strong>{{ $land->name }}'s
                                                Map</strong>
                                        </h2>
                                        <div id="map" style="height:800px; width: 1230px;" class="my-3 mx-auto"></div>
                                        <script>
                                            let map;

                                            function initMap() {
                                                map = new google.maps.Map(document.getElementById("map"), {
                                                    center: {
                                                        lat: {!! $land->lat !!},
                                                        lng: {!! $land->long !!}
                                                    },
                                                    zoom: 30,
                                                    scrollwheel: true,
                                                    mapTypeId: 'satellite'
                                                });

                                                const uluru = {
                                                    lat: {!! $land->lat !!},
                                                    lng: {!! $land->long !!}
                                                };
                                                let marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map,
                                                    draggable: false
                                                });

                                                google.maps.event.addListener(marker, 'position_changed',
                                                    function() {
                                                        let lat = marker.position.lat()
                                                        let lng = marker.position.lng()
                                                        $('.lat').val(lat)
                                                        $('.lng').val(lng)
                                                    })

                                                google.maps.event.addListener(map, 'click',
                                                    function(event) {
                                                        pos = event.latLng
                                                        marker.setPosition(pos)
                                                    })
                                            }
                                        </script>
                                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="panel3" role="tabpanel">
                    <br>
                    <div class="card hoverable">
                        <br>
                        <div class="m-3">
                            <div class="col-lg-12">

                                <div class="dark-grey-text d-flex  align-items-center pt-3   pl-4 ">
                                    <div>
                                        <h2 class="card-title font-weight-bold pt-2 pb-3 m-2 ">
                                            <strong>{{ $land->name }}'s
                                                Gallery</strong>
                                        </h2>
                                        <section id="newyork" class="section pb-4">
                                            <div class="row wow fadeIn" data-wow-delay="0.4s">
                                                <div class="col-md-12">
                                                    <div id="mdb-lightbox-ui"></div>
                                                    <div class="mdb-lightbox">
                                                        @php
                                                            $picArray = explode(',', $land->gallery);
                                                            
                                                        @endphp
                                                        @foreach ($picArray as $pic)
                                                            <figure class="col-md-4">

                                                                <a href="{{ asset("images/lands/$pic") }}"
                                                                    data-size="1600x1067">

                                                                    <img src="{{ asset("images/lands/$pic") }}"
                                                                        class="img-fluid z-depth-1">

                                                                </a>
                                                            </figure>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection
