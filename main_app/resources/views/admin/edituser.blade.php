 @extends('layouts.admin_app')

 @section('content')
 @include('layouts.alerts')
     <div class="m-5 mx-auto pt-3 ">
         <section class="pb-5">
             <div class="mb-5">
                 <div class="">
                     <div class="">

                         <ul class="nav md-tabs nav-justified grey lighten-3 mx-0" role="tablist">

                             <li class="nav-item">

                                 <a class="nav-link active dark-grey-text font-weight-bold" data-toggle="tab" href="#panel1"
                                     role="tab"> Profile</a>
                             </li>


                             <li class="nav-item">
                                 <a class="nav-link dark-grey-text font-weight-bold" data-toggle="tab" href="#panel2"
                                     role="tab">
                                     Properties</a>
                             </li>


                             <li class="nav-item">

                                 <a class="nav-link dark-grey-text font-weight-bold" data-toggle="tab" href="#panel3"
                                     role="tab">
                                     </i>Password </a>
                             </li>

                             <li class="nav-item">

                                 <a class="nav-link dark-grey-text font-weight-bold" data-toggle="tab" href="#panel4"
                                     role="tab">
                                     </i>Notifications </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>




             <div class="tab-content card shadow-box-example z-depth-5 " style="margin-top: 20px">
                 <div class="tab-pane fade in show active animated zoomIn" id="panel1" role="tablist">
                     <div class="">
                         <div class="col-md-5 mx-auto text-center">
                             @if ($user->profile_pic)
                                 <img style="width: 70px; height: 70px" class="rounded-circle"
                                     src="/storage/profile_pics/{{ $user->profile_pic }}" alt="" srcset="">
                                 <br>
                             @else
                                 <img style="width: 70px; height: 70px" class="rounded-circle"
                                     src="{{ url('images/user.jpg') }}" alt="" srcset=""> <br>
                             @endif
                             <p class="fw-bold mb-3 py-2">{{ $user->name }}</p>

                             <span class="fw-bold  badge badge-success">{{ $user->role }}</span>
                             <br>

                             <div class="form-group">
                                 {!! Form::open([
                                     'action' => ['App\Http\Controllers\Admin\UsersController@update', $user->id],
                                     'method' => 'POST',
                                     'enctype' => 'multipart/form-data',
                                 ]) !!}

                                 {{ Form::file('profile_pic', ['style' => 'font-size:12px']) }}
                                 {{ Form::hidden('_method', 'PUT') }}
                                 {{ Form::submit('UPLOAD', ['class' => 'btn btn-sm btn-primary']) }}
                                 {!! Form::close() !!}
                             </div>



                         </div>

                         <div class="col-md-10 mx-auto">
                             {!! Form::open([
                                 'action' => ['App\Http\Controllers\Admin\UsersController@update', $user->id],
                                 'method' => 'POST',
                             ]) !!}

                             <div class="row">
                                 <div class="col">
                                     {{ Form::label('username', 'Username') }}
                                     {{ Form::text('username', $user->name, ['class' => 'form-control', 'plcaholder' => 'Username']) }}

                                 </div>
                                 <div class="col">
                                     {{ Form::label('email', 'Email') }}
                                     {{ Form::email('email', $user->email, ['class' => 'form-control', 'plcaholder' => 'Email']) }}
                                 </div>
                                 <div class="col">
                                     {{ Form::label('role', 'Role') }}
                                     {{ Form::text('role', $user->role, ['class' => 'form-control', 'plcaholder' => 'Role']) }}
                                 </div>

                               

                             </div>
                             <br>
                             <br>
                             {{ Form::hidden('_method', 'PUT') }}
                             {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary']) }}
                             {!! Form::close() !!}

                         </div>

                     </div>
                 </div>



                 <div class="tab-pane fade" id="panel2" role="tabpanel">
                     @if (count($portions) == 0)
                         <div class="dark-grey-text d-flex  align-items-center pt-3 pb-4 pl-4 ">
                             <div class="mx-auto">

                                 <h4 class="m-4 ">No Properties</h4>

                             </div>
                         </div>
                     @else
                         <section>
                             <h5 class="my-4 dark-grey-text font-weight-bold">User properties</h5>

                             <div class="card card-cascade narrower z-depth-1">
                                 <div
                                     class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                                     <a href="" class="white-text mx-3">Choose portion to edit</a>
                                 </div>


                                 <div class="px-4">
                                     <div class="table-responsive">
                                         <table class="table table-hover mb-1 animated fadeIn">
                                             <thead>
                                                 <tr>
                                                     <th class="th-lg"><a>Portion ID<i class=""></i></a></th>
                                                     <th class="th-lg"><a href="">Location<i class=""></i></a>
                                                     </th>

                                                     <th class="th-lg"><a href="">Due time<i class=""></i></a>
                                                     </th>
                                                     <th class="th-lg"><a href="">Size<i class=""></i></a>
                                                     </th>
                                                     <th class="th-lg"><a href="">Price<i class=""></i></a>
                                                     </th>
                                                     <th class="th-lg"><a href="">Status<i class=""></i></a>
                                                     <th class="th-lg"><a href="">Payments<i class=""></i></a>
                                                     <th class="th-lg"><a href="">Action<i class=""></i></a>
                                                     </th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 @foreach ($portions as $portion)
                                                     @php
                                                         
                                                         $land_id = \App\Models\Land::where('name', $portion->land_id)->first();
                                                         $payment = \App\Models\Payment::where('portion_id', $portion->id)->first();
                                                         $due =  \Carbon\Carbon::parse($portion->due_date)->format('d-m-Y');
                                                         
                                                     @endphp
                                                     @push('scripts')
                                                         <script>
                                                             var pid = {!! json_encode($portion->id) !!};
                                                         </script>
                                                     @endpush

                                                     <tr data-row="{{ $portion->id }}" class="p-0">


                                                         <td>{{ $portion->id }}</td>
                                                         <td>{{ $land_id->name }}</td>


                                                         <td>
                                                            @if ($payment->status == 'not')
                                                                 {{-- <button class="datepicker btn btn-sm btn-grey"  name="date" data-countdown="{{ $portion->due_date }}"></button> --}}
                                                                 {{-- <label data-countdown="{{ $portion->due_date }}"></label> --}}

                                                                 <div class="md-form form-sm p-0 mt-0 mb-0">
                                                                     {!! Form::open([
                                                                         'action' => ['App\Http\Controllers\Admin\PortionsController@update', $portion->id],
                                                                         'method' => 'POST',
                                                                         'enctype' => 'multipart/form-data',
                                                                     ]) !!}
                                                                     {{ Form::text('date', $due, ['class' => 'form-control form-control datepicker p-0', 'plcaholder' => 'portiondue']) }}
                                                                     {{ Form::hidden('_method', 'PUT') }}
                                                                     {{ Form::submit('Update', ['class' => 'btn btn-xs btn-primary p-0 ml-auto']) }}
                                                                     {!! Form::close() !!}
                                                                 </div>
                                                             @else
                                                                 <span class="badge badge-info">done</span>
                                                             @endif
                                                         </td>

                                                         @if ($portion->size)
                                                             <td>{{ $portion->size }} sqm</td>
                                                         @else
                                                             <td>not assigned</td>
                                                         @endif

                                                         @if ($portion->price)
                                                             <td>{{ $portion->price }} TZS</td>
                                                         @else
                                                             <td>not assigned</td>
                                                         @endif
                                                          @if ($portion->status == 'taken')
                                                             <td> <span
                                                                     class="badge badge-danger">{{ $portion->status }}</span>
                                                             </td>
                                                         @else
                                                             <td> <span
                                                                     class="badge badge-info">{{ $portion->status }}</span>
                                                             </td>
                                                         @endif
                                                         <td class="w-auto">

                                                             <small>Paid: </small><span
                                                                 class="badge badge-info">{{ $payment->amount }}
                                                                 TZS</span><br>
                                                             <small>Rem: </small><span
                                                                 class="badge badge-info">{{ $portion->price - $payment->amount }}
                                                                 TZS</span><br>

                                                         </td>

                                                         <td>
                                                             @if ($payment->status == 'full')
                                                                 <a href="/pdf/{{ $portion->id }}" target="_blank"
                                                                     class="btn btn-sm btn-success ml-2">Download</a>
                                                             @elseif($payment->status == 'half')
                                                                 @if (!is_null($payment->payslip))
                                                                     <a class="btn btn-sm btn-primary ml-2"
                                                                         data-toggle="modal"
                                                                         href="#pay{{ $portion->id }}">review</a>
                                                                 @else
                                                                     <span class="badge badge-danger ml-2">No
                                                                         receipt</span>
                                                                 @endif
                                                             @elseif($payment->status == 'not')
                                                                 @if (!is_null($payment->payslip))
                                                                     <a class="btn btn-sm btn-primary ml-2"
                                                                         data-toggle="modal"
                                                                         href="#pay{{ $portion->id }}">review</a>
                                                                 @else
                                                                     <form action="/releaseadm/{{ $portion->id }}"
                                                                         method="POST">
                                                                         @csrf
                                                                         <div class="">
                                                                             <button class="btn btn-danger btn-sm"
                                                                                 type="submit">Release</button>
                                                                         </div>
                                                                     </form>
                                                                 @endif
                                                             @endif
                                                         </td>

                                                     </tr>
                                                     <div id="pay{{ $portion->id }}" class="modal fade">

                                                         <div class="modal-dialog">
                                                             <div class="modal-content">

                                                                 <div class="modal-header">
                                                                     <h4 class="card-title h4 mb-3"><strong><a
                                                                                 href="" class="grey-text">REVIEW
                                                                                 PAYMENT</a></strong></h4>
                                                                     <button type="button" class="close"
                                                                         data-dismiss="modal"
                                                                         aria-hidden="true">&times;</button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <p>Are you sure you want to grant portion <strong>
                                                                             {{ $portion->id }}</strong>
                                                                         , with referennce number
                                                                         <strong> {{ $payment->control_num }} </strong>

                                                                         <br>



                                                                         @if (is_null($payment->payslip))
                                                                             <p>No Image</p>
                                                                         @else
                                                                             <div class="mt-3 ml-auto text-center">
                                                                                 <i class="p-2">View the screenshot
                                                                                     below</i>
                                                                                 <img src="/storage/payslips/{{ $payment->payslip }}"
                                                                                     class="img-thumbnail"
                                                                                     alt="Fallback Image">

                                                                                 <div>
                                                                         @endif
                                                                     </p>
                                                                 </div>

                                                                 <div class="mx-auto col-md-9">
                                                                     <form method="POST"
                                                                         action="{{ route('manage_buys.update', $portion->id) }}">
                                                                         @csrf
                                                                         @method('PUT')
                                                                         <div class="md-form form-sm pb-0">
                                                                             <label for="amount">Amount</label>
                                                                             <input type="text" id="amount"
                                                                                 name="amount" value="0.00000"
                                                                                 class="form-control form-control">
                                                                         </div>
                                                                         <button type="submit"
                                                                             class="btn btn-sm btn-success">save</button>
                                                                     </form>

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
                     @endif
                 </div>


                 <div class="tab-pane fade col-md-9 mx-auto animated fadeIn" id="panel3" role="tabpanel">
                     <form method="POST" action="{{ route('password.update') }}">
                         @csrf
                         <div class="row">
                             <div class="col">
                                 <label for="password" :value="__('Password')">Password</label>

                                 <input id="password" class="form-control" type="password" name="password" required />
                             </div>
                             <div class="col">
                                 <label for="password_confirmation" :value="__('Confirm Password')">Confirm
                                     Password</label>
                                 <input id="password_confirmation" class="form-control" type="password"
                                     name="password_confirmation" required />
                             </div>
                         </div>
                         <div class="flex items-center justify-end mt-4">
                             <button class="btn btn-sm btn-primary">
                                 {{ __('Reset Password') }}
                             </button>
                         </div>
                     </form>
                 </div>

                 <div class="tab-pane fade col-md-9 mx-auto animated fadeIn" id="panel4" role="tabpanel">
                     @if (count($notifications) == 0)
                         <div class="dark-grey-text d-flex  align-items-center pt-3 pb-4 pl-4 ">
                             <div class="mx-auto">

                                 <h4 class="m-4 ">No Notifications</h4>

                             </div>
                         </div>
                     @else
                         @foreach ($notifications as $notification)
                             <div class="dark-grey-text d-flex  align-items-center pt-3 pl-4 ">
                                 <div>
                                     <h6 class="card-title font-weight-bold pt-2 ">
                                         <strong>{{ $notification->title }}</strong>
                                     </h6>
                                     <p class="">{{ $notification->desc }}</p>
                                     <span class="float-right"><i class="far fa-clock" aria-hidden="true"></i>
                                         {{ $notification->created_at->diffForHumans() }}</span>
                                 </div>
                             </div>
                             <hr>
                         @endforeach
                     @endif
                 </div>
             </div>
         </section>
     </div>
 @endsection
