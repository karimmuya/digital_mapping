 @extends('layouts.admin_app')

 @section('content')
 @include('layouts.alerts')
     <h5 class="my-4 dark-grey-text font-weight-bold animated fadeInLeft">Edit | Manage Portions</h5>
     <div class="card mt-2 mb-4 hoverable animated zoomIn">
         <div class="m-3">
             <div class="col-lg-12 m-auto">
                 <div class="m-3">
                     <div class="m-1 mb-4">
                         <div class="row ">
                             <div>
                                 @foreach ($land as $land)
                                     <h5 class="text text-"><strong>{{ $land->name }}</strong></h5>
                                 @endforeach

                             </div>
                             <div class="ml-auto ">
                                 <span class="badge badge-pill badge-primary">Reserved</span>
                                 <span class="badge badge-pill badge-danger">Taken</span>
                                 <span class="badge badge-pill badge-dark">Available</span>
                             </div>
                         </div>
                     </div>

                     <svg id="svg" version="1.0" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 2376.000000 1144.000000" preserveAspectRatio="xMidYMid meet">
                         <g transform="translate(0.000000,1144.000000) scale(0.100000,-0.100000)">
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
                                 <path class="path-class" d="{{ $dAttribute }}" style="fill: {{ $portions->fill }};"
                                     id={{ $portions->id }}></path>
                             @endforeach
                         </g>
                     </svg>
                 </div>
             </div>
         </div>
     </div>
 @endsection
