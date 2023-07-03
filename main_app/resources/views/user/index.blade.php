@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-4 pt-2" style="width: 87%">
        <nav class="navbar navbar-expand-lg navbar-dark primary-color mt-5 animated fadeInDown"> <a
                class="font-weight-bold white-text mr-4" href="#">Home</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <form class="search-form ml-auto" role="search">
                    <div class="form-group md-form my-0 waves-light"> <input type="text" class="form-control"
                            placeholder="Search"> </div>
                </form>
            </div>
        </nav>
    </div>
    <div class="mx-auto px-4" style="width: 90%">
        <div class="row pt-2">
            <div class="col-lg-12">
                <section class="section  pb-4 animated fadeInDown">
                    <div class="card mt-4 hoverable ">
                        <div class="m-3">
                            <div class="col-lg-12">

                                <div class="dark-grey-text d-flex  align-items-center pt-4 pb-4 pl-4 ">
                                    <div>
                                        <h2 class="card-title font-weight-bold pt-2 "><strong>We Help You Discover Your
                                                Dream Land.</strong></h2>
                                        <p class="">Ready to give our clients amazing experience of owning their dream
                                            land
                                            through digital mapping technology.
                                            We are dedicated to deliver excellent and proffesional services that exceed your
                                            expectations by shaping the future of how you live.</p>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                @if (count($lands) > 0)
                    <section>
                        <div class="row">

                            <div class="col-12 mt-4  animated fadeInUp">
                                <div class="row ">
                                    @foreach ($lands as $land)
                                        @php
                                            $portion = \App\Models\Portion::where('land_id', $land->name)->get();
                                            
                                        @endphp
                                        <div class="col-lg-4 col-md-12 mb-4 ">
                                            <div class="card card-ecommerce hoverable">
                                                {{-- <div class="view overlay"> <img src="{{ asset('images/image.png') }}"
                                                        class="img-fluid" alt=""> <a>
                                                        <div class="mask rgba-white-slight"></div>
                                                    </a> </div> --}}
                                                <svg id="svg" version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 10 2376.000000 1144.000000"
                                                    preserveAspectRatio="xMidYMid meet">
                                                    <g
                                                        transform="translate(0.000000,1144.000000) scale(0.100000,-0.100000)">
                                                        @foreach ($portion as $portion)
                                                            @php
                                                                
                                                                $pattern = '/<path[^>]*\bd="(.*?)".*<\/path>/s';
                                                                preg_match($pattern, $portion->vector, $matches);
                                                                
                                                                if (isset($matches[1])) {
                                                                    $dAttribute = $matches[1];
                                                                } else {
                                                                    $dAttribute = '';
                                                                }
                                                                
                                                            @endphp
                                                            <path class="path-class" d="{{ $dAttribute }}"
                                                                style="fill: {{ $portion->fill }}; pointer-events: none;"
                                                                id={{ $portion->id }}></path>
                                                        @endforeach

                                                    </g>
                                                </svg>
                                                <div class="card-body ">
                                                    <h5 class="card-title mb-1"><strong><a
                                                                href="/portions/{{ $land->name }}"
                                                                class="dark-grey-text">{{ $land->name }}</a></strong>
                                                    </h5> <span class="badge badge-success mb-2">Price: TZS
                                                        {{ $land->pricepersqm }}/SQM</span>

                                                    <span class="badge badge-primary mb-2">Starting from: TZS
                                                        {{ $land->stprice }}</span>

                                                    <div class="card-footer pb-0">
                                                        <div class="row mb-0">
                                                            <small
                                                                class="text-sm m-auto col">{{ $land->created_at->diffForHumans() }}</small>
                                                            <a href="/portions/{{ $land->name }}"
                                                                class="btn btn-primary btn-sm btn-rounded text-white ml-auto  col-md-5">view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <div class="dark-grey-text d-flex  align-items-center pt-3 pb-4 pl-4 ">
                        <div class="mx-auto">

                            <h4 class="m-4 ">Nothing to show here 🥹</h4>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
