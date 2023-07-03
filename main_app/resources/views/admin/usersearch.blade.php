 @extends('layouts.admin_app')

 @section('content')
     @include('layouts.alerts')
     @if (count($users) > 0)
         <section>

             <div class="row mx-auto">
                 <h5 class="mt-3 dark-grey-text font-weight-bold col-md-9 animated fadeIn">Users Search Results.</h5>

             </div>


             <div class="card card-cascade narrower z-depth-1">
                 <div
                     class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                     <a href="" class="white-text mx-3">Choose a user to edit</a>
                 </div>


                 <div class="px-4 hoverable">
                     <div class="table-responsive ">
                         <table class="table table-hover mb-1 animated fadeIn">
                             <thead>
                                 <tr>
                                     <th class="th-lg"><strong>Username</strong>
                                     <th class="th-lg"><strong>Email</strong>
                                     <th class="th-lg"><strong>Role</strong>
                                     <th class="th-lg"><strong>Plots reserved</strong>
                                     <th class="th-lg"><strong>Plots bought</strong>
                                     </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($users as $user)
                                     @php
                                         $reserved = \App\Models\Portion::where('user_id', $user->id)->count();
                                         $bought = \App\Models\Portion::where('bought_by', $user->id)->count();
                                     @endphp
                                     <tr>
                                         <td>{{ $user->name }}</td>
                                         <td>{{ $user->email }}</td>
                                         <td>{{ $user->role }}</td>
                                         <td>{{ $reserved }}</td>
                                         <td>{{ $bought }}</td>
                                         <td>

                                             <a href="/manage_users/{{ $user->id }}"
                                                 class="btn btn-sm btn-primary mx-3">edit</a>
                                             <a href="#deleteUserModal{{ $user->id }}"
                                                 class="btn btn-sm btn-danger mx-3" data-toggle="modal">
                                                 DELETE
                                                 </i></a>
                                         </td>

                                     </tr>
                                     <div id="deleteUserModal{{ $user->id }}" class="modal fade">
                                         <div class="modal-dialog">
                                             <div class="modal-content">

                                                 <div class="modal-header">
                                                     <h4 class="card-title h4 mb-3"><strong><a href=""
                                                                 class="grey-text">DELETE USER</a></strong></h4>
                                                     <button type="button" class="close" data-dismiss="modal"
                                                         aria-hidden="true">&times;</button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <p>Are you sure you want to delete this user?</p>
                                                     <p class="text-warning"><small>This action cannot be undone.</small>
                                                     </p>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <input type="button" class="btn btn-sm btn-default"
                                                         data-dismiss="modal" value="Cancel">
                                                     {!! Form::open([
                                                         'action' => ['App\Http\Controllers\Admin\UsersController@destroy', $user->id],
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

                 <h4 class="m-4 ">No Users</h4>

             </div>
         </div>
     @endif
 @endsection
