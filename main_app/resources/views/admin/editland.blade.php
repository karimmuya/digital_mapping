 @extends('layouts.admin_app')

 @section('content')
     <h5 class="my-4 dark-grey-text font-weight-bold animated fadeInLeft">Edit - Manage Lands</h5>
     <div class="pt-3">
         <section class="pb-5">
         @include('layouts.alerts')
             @foreach ($land as $land)
                 <div class="card hoverable animated fadeInUp">
                     <div class="m-3 row">
                         <div class="col-md-9">
                             <div class="m-auto pb-3">
                                 <div id="map" style="height:700px; width: 800px;" class="my-3"></div>
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
                                             draggable: true
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
                         <div class="col-md-3">
                             {!! Form::open([
                                 'action' => ['App\Http\Controllers\Admin\LandsController@update', $land->id],
                                 'method' => 'POST',
                             ]) !!}


                             <div class="md-form form-sm">
                                 {{ Form::label('name', 'Land name', ['id' => 'name']) }}
                                 {{ Form::text('name', $land->name, ['class' => 'form-control form-control ', 'id' => 'name']) }}
                             </div>

                             <div class="md-form form-sm">
                                 {{ Form::label('district', 'District', ['id' => 'district']) }}
                                 {{ Form::text('district', $land->district, ['class' => 'form-control form-control ', 'id' => 'district']) }}
                             </div>

                             <div class="md-form form-sm">
                                 {{ Form::label('region', 'Region', ['id' => 'region']) }}
                                 {{ Form::text('region', $land->region, ['class' => 'form-control form-control ', 'id' => 'region']) }}
                             </div>

                             <div class="md-form form-sm">
                                 {{ Form::label('pricepersqm', 'Price per sqm', ['id' => 'price']) }}
                                 {{ Form::text('pricepersqm', $land->pricepersqm, ['class' => 'form-control form-control ', 'id' => 'price']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('stprice', 'Starting price', ['id' => 'stprice']) }}
                                 {{ Form::text('stprice', $land->stprice, ['class' => 'form-control form-control ', 'id' => 'stprice']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('pymnt_season', 'Payment months', ['id' => 'session']) }}
                                 {{ Form::text('pymnt_season', $land->pymnt_season, ['class' => 'form-control form-control ', 'id' => 'session']) }}
                             </div>
                              <div class="md-form form-sm">
                                 {{ Form::label('acc_num', 'Account number', ['id' => 'accnum']) }}
                                 {{ Form::text('acc_num', $land->acc_num, ['class' => 'form-control form-control ', 'id' => 'accnum']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('phone', 'Owner\'s phone', ['id' => 'phone']) }}
                                 {{ Form::text('phone', $land->phone, ['class' => 'form-control form-control ', 'id' => 'phone']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('mradi', 'Mradi', ['id' => 'mradi']) }}
                                 {{ Form::text('mradi', $land->mradi, ['class' => 'form-control form-control ', 'id' => 'mradi']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('latitude', 'Latitude', ['id' => 'lat']) }}
                                 {{ Form::text('latitude', $land->lat, ['class' => 'form-control form-control lat ', 'name' => 'lat', 'id' => 'lat']) }}
                             </div>
                             <div class="md-form form-sm">
                                 {{ Form::label('longitude', 'Longitude', ['id' => 'lng']) }}
                                 {{ Form::text('longitude', $land->long, ['class' => 'form-control form-control lng', 'name' => 'lng', 'id' => 'lng']) }}
                             </div>
                             {{ Form::hidden('_method', 'PUT') }}
                             {{ Form::submit('save', ['class' => 'btn btn-sm btn-primary waves-effect']) }}
                             {!! Form::close() !!}

                         </div>
                     </div>
                 </div>
     </div>
     @endforeach
     </section>
     </div>
 @endsection
