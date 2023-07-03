 @extends('layouts.admin_app')

 @section('content')
     @include('layouts.alerts')

     <section class="pb-5">

         <div class="col-md-12 mx-auto">
             @if (count($payments) == 0)
                 <div class="dark-grey-text d-flex  align-items-center pt-3 pb-4 pl-4 ">
                     <div class="mx-auto">

                         <h4 class="m-4 ">No Payments</h4>

                     </div>
                 </div>
             @else
                 <section>
                     <h5 class="my-4 dark-grey-text font-weight-bold animated fadeIn">Manage Payments</h5>

                     <div class="card card-cascade narrower z-depth-1">
                         <div
                             class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                             <a href="" class="white-text mx-3">Choose payment to edit</a>
                         </div>


                         <div class="px-4">
                             <div class="table-responsive">
                                 <table class="table table-hover mb-1 animated fadeIn">
                                     <thead>
                                         <tr>
                                             <th class="th-lg"><a>User<i class=""></i></a></th>
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
                                         @foreach ($payments as $payments)
                                             @php
                                                 
                                                 $portion = \App\Models\Portion::where('id', $payments->portion_id)->first();
                                                 $user = \App\Models\User::where('id', $payments->user_id)->first();
                                                 $land_id = \App\Models\Land::where('name', $portion->land_id)->first();
                                                 $due = \Carbon\Carbon::parse($portion->due_date)->format('d-m-Y');
                                                 
                                             @endphp
                                             <tr>
                                                 <td>{{ $user->name }}</td>
                                                 <td>{{ $portion->id }}</td>
                                                 <td>{{ $land_id->name }}</td>


                                                 <td>
                                                     @if ($payments->status == 'not')
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
                                                     <td> <span class="badge badge-danger">{{ $portion->status }}</span>
                                                     </td>
                                                 @else
                                                     <td> <span class="badge badge-info">{{ $portion->status }}</span>
                                                     </td>
                                                 @endif
                                                 <td class="w-auto">

                                                     <small>Paid: </small><span
                                                         class="badge badge-info">{{ $payments->amount }}
                                                         TZS</span><br>
                                                     <small>Rem: </small><span
                                                         class="badge badge-info">{{ $portion->price - $payments->amount }}
                                                         TZS</span><br>

                                                 </td>

                                                 <td>
                                                     @if ($payments->status == 'full')
                                                         <a href="/pdf/{{ $portion->id }}" target="_blank"
                                                             class="btn btn-sm btn-success ml-2">Download</a>
                                                     @elseif($payments->status == 'half')
                                                         @if (!is_null($payments->payslip))
                                                             <a class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                                                                 href="#pay{{ $portion->id }}">review</a>
                                                         @else
                                                             <span class="badge badge-danger ml-2">No receipt</span>
                                                         @endif
                                                     @elseif($payments->status == 'not')
                                                         @if (!is_null($payments->payslip))
                                                             <a class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                                                                 href="#pay{{ $portion->id }}">review</a>
                                                         @else
                                                             <form action="/releaseadm/{{ $portion->id }}" method="POST">
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
                                                             <h4 class="card-title h4 mb-3"><strong><a href=""
                                                                         class="grey-text">REVIEW
                                                                         PAYMENT</a></strong>
                                                             </h4>
                                                             <button type="button" class="close" data-dismiss="modal"
                                                                 aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                             <p>Are you sure you want to grant portion <strong>
                                                                     {{ $portion->id }}</strong>
                                                                 , with referennce number
                                                                 <strong> {{ $payments->control_num }}
                                                                 </strong>

                                                                 <br>



                                                                 @if (is_null($payments->payslip))
                                                                     <p>No Image</p>
                                                                 @else
                                                                     <div class="mt-3 ml-auto text-center">
                                                                         <i class="p-2">View the screenshot
                                                                             below</i>
                                                                         <img src="/storage/payslips/{{ $payments->payslip }}"
                                                                             class="img-thumbnail" alt="Fallback Image">

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
                                                                     <input type="text" id="amount" name="amount"
                                                                         value="0.00000" class="form-control form-control">
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

     </section>

 @endsection
