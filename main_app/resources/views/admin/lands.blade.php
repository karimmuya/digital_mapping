 @extends('layouts.admin_app')

 @section('content')
     @include('layouts.alerts')
     @if (count($lands) > 0)
         <section>
             <h5 class="my-4 dark-grey-text font-weight-bold animated fadeIn">Manage Lands</h5>

             <div class="card card-cascade narrower z-depth-1 ">
                 <div
                     class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                     <a href="" class="white-text mx-3">Choose a location to edit</a>
                 </div>


                 <div class="px-4 hoverable ">
                     <div class="table-responsive ">
                         <table class="table table-hover mb-0 animated fadeIn">
                             <thead>
                                 <tr>

                                     <th class="th-lg"><strong>Land</strong></th>
                                     <th class="th-lg"><strong>Region</strong>
                                     </th>
                                     <th class="th-lg"><strong>District</strong></th>
                                     <th class="th-lg"><strong>Price per sqm</strong></th>
                                     <th class="th-lg"><strong>Mradi</strong></th>
                                     <th class="th-lg"><strong>Owner</strong></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($lands as $land)
                                     <tr>


                                         <td>{{ $land->name }}</td>
                                         <td>{{ $land->region }}</td>
                                         <td>{{ $land->district }}</td>
                                         <td>{{ $land->pricepersqm }}</td>
                                         <td>{{ $land->district }}</td>
                                         <td>{{ $land->phone }}</td>
                                         <td>


                                             <a href="/manage_lands/{{ $land->name }}"
                                                 class="btn btn-sm btn-primary">edit</a>
                                         </td>
                                         <td> <a href="#deleteLandModal{{ $land->id }}" class="btn btn-sm btn-danger"
                                                 data-toggle="modal">
                                                 DELETE
                                                 </i></a>
                                         </td>
                                     </tr>

                                     <div id="deleteLandModal{{ $land->id }}" class="modal fade">
                                         <div class="modal-dialog">
                                             <div class="modal-content">

                                                 <div class="modal-header">
                                                     <h4 class="card-title h4 mb-3"><strong><a href=""
                                                                 class="grey-text">DELETE LAND</a></strong></h4>
                                                     <button type="button" class="close" data-dismiss="modal"
                                                         aria-hidden="true">&times;</button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <p>Are you sure you want to delete this land?</p>
                                                     <p class="text-warning"><small>This action cannot be undone.</small>
                                                     </p>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <input type="button" class="btn btn-sm btn-default"
                                                         data-dismiss="modal" value="Cancel">
                                                     {!! Form::open([
                                                         'action' => ['App\Http\Controllers\Admin\LandsController@destroy', $land->id],
                                                         'method' => 'POST',
                                                     ]) !!}
                                                     {{ Form::hidden('_method', 'DELETE') }}
                                                     @csrf
                                                     <button type="submit" class="btn btn-danger btn-sm"
                                                         style="float:right">Delete</button>

                                                     {!! Form::close() !!}
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
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

                 <h4 class="m-4 ">No Lands</h4>

             </div>
         </div>
     @endif
 @endsection
