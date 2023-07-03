 @extends('layouts.admin_app')

 @section('content')
     @include('layouts.alerts')
     @if (count($lands) > 0)
         <section>
             <h5 class="my-4 dark-grey-text font-weight-bold animated fadeIn">Manage Portions</h5>

             <div class="card card-cascade narrower z-depth-1">
                 <div
                     class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                     <a href="" class="white-text mx-3">Choose location to edit it's portions</a>
                 </div>

                 <div class="px-4 hoverable">
                     <div class="table-responsive">
                         <table class="table table-hover mb-1 animated fadeIn">
                             <thead>
                                 <tr>

                                     <th class="th-lg"><strong>Location</strong></th>
                                     <th class="th-lg"><strong>Region<strong> </th>
                                     <th class="th-lg"><strong>District</strong></th>
                                     <th class="th-lg"><strong>Price/SQM</strong></th>
                                     <th class="th-lg"><strong>Total portions</strong></th>
                                     <th class="th-lg"><strong>Action</strong></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($lands as $land)
                                     @php
                                         $count = \App\Models\Portion::where('land_id', $land->name)
                                             ->where('status', '!=', 'disabled')
                                             ->count();
                                     @endphp
                                     <tr>
                                         <td>{{ $land->name }}</td>
                                         <td>{{ $land->region }}</td>
                                         <td>{{ $land->district }}</td>
                                         <td>{{ $land->pricepersqm }} TZS</td>
                                         <td>{{ $count }}</td>
                                         <td>
                                             <a href="/manage_portions/{{ $land->name }}"
                                                 class="btn btn-sm btn-primary mt-2">edit</a>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>

                 </div>
             </div>
         </section>
     @else
         <div class="dark-grey-text d-flex  align-items-center pt-3 pb-4 pl-4 ">
             <div class="mx-auto">

                 <h4 class="m-4 ">No Portions</h4>

             </div>
         </div>
     @endif
 @endsection
