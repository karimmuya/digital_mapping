@extends('layouts.app')


@section('content')
    <div class="m-5 mx-auto pt-3 col-md-10">
        <section class="pb-5">
            @include('layouts.alerts')
            <div class=" mt-5 mb-5">
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
                                    My properties</a>
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
                            @if (Auth::user()->profile_pic)
                                <img style="width: 70px; height: 70px" class="rounded-circle"
                                    src="/storage/profile_pics/{{ Auth::user()->profile_pic }}" alt=""
                                    srcset=""> <br>
                            @else
                                <img style="width: 70px; height: 70px" class="rounded-circle"
                                    src="{{ url('images/user.jpg') }}" alt="" srcset=""> <br>
                            @endif
                            <p class="fw-bold mb-3 py-2">{{ Auth::user()->name }}</p>

                            <span class="fw-bold  badge badge-success">{{ Auth::user()->role }}</span>
                            <br>

                            <div class="form-group">
                                {!! Form::open([
                                    'action' => ['App\Http\Controllers\User\ProfileController@update', Auth::user()->id],
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
                                'action' => ['App\Http\Controllers\User\ProfileController@update', Auth::user()->id],
                                'method' => 'POST',
                            ]) !!}

                            <div class="row">
                                <div class="col">
                                    {{ Form::label('username', 'Username') }}
                                    {{ Form::text('username', Auth::user()->name, ['class' => 'form-control', 'plcaholder' => 'Username']) }}

                                </div>
                                <div class="col">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::email('email', Auth::user()->email, ['class' => 'form-control', 'plcaholder' => 'Email']) }}
                                </div>

                                <div class="col">
                                    {{ Form::label('phone', 'Phone') }}
                                    {{ Form::text('phone', Auth::user()->phone, ['class' => 'form-control', 'plcaholder' => 'Email']) }}
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
                            <h5 class="my-1 dark-grey-text font-weight-bold">My properties</h5>

                            <div class="card card-cascade narrower z-depth-1">
                                <div
                                    class="view view-cascade gradient-card-header blue-gradient narrower p-2 mx-4 my-3 d-flex justify-content-between align-items-center">
                                    <a href="" class="white-text mx-3">Properties</a>

                                    {{-- <form class="form-outline md-form  row ml-auto " style="width: 50%">
                                    <input class="form-control  col-md-9" type="text" placeholder="Search"
                                        style="">
                                    <button class="btn  ml-3" tyle="background-color:transparent"><i
                                            class="fas fa-search"></i> </button>
                                </form> --}}
                                </div>


                                <div class="px-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-1 animated fadeIn">
                                            <thead>
                                                <tr>
                                                    <th class="w-auto"><strong>Portion ID<i class=""></strong></th>
                                                    <th class="w-auto"><strong>Land<i class=""></strong></th>

                                                    </th>
                                                    <th class="w-auto"><strong>Due time<i class=""></strong></th>

                                                    <th class="w-auto"><strong>Size<i class=""></strong></th>
                                                    <th class="w-auto"><strong>Price<i class=""></strong></th>
                                                    <th class="w-auto"><strong>Status<i class=""></strong></th>
                                                    <th class="w-auto"><strong>Payment<i class=""></strong></th>
                                                    <th class="w-auto"><strong>Action<i class=""></strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($portions as $portion)
                                                    @php
                                                        
                                                        $land_id = \App\Models\Land::where('name', $portion->land_id)->first();
                                                        $payment = \App\Models\Payment::where('portion_id', $portion->id)->first();
                                                        
                                                    @endphp

                                                    <tr>

                                                        <td class="w-auto">{{ $portion->id }}</td>
                                                        <td class="w-auto">{{ $land_id->name }}</td>


                                                        <td class="w-auto">
                                                            @if ($payment->status == 'not')
                                                                <span data-countdown="{{ $portion->due_date }}"></span>
                                                            @else
                                                                <span class="badge badge-info">taken</span>
                                                            @endif
                                                        </td>


                                                        <td class="w-auto">{{ $portion->size }}</td>
                                                        <td class="w-auto">{{ $portion->price }} TZS</td>
                                                        <td class="w-auto">{{ $portion->status }}</td>
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
                                                                    class="btn btn-sm btn-success ml-2">Download</a><br>
                                                            @elseif($payment->status == 'half')
                                                                @if (is_null($payment->payslip))
                                                                    <a class="btn btn-sm btn-primary ml-2"
                                                                        data-toggle="modal"
                                                                        href="#pay{{ $portion->id }}">pay</a>
                                                                @else
                                                                    <span class="badge badge-info ml-2">Pending..</span>
                                                                @endif
                                                            @elseif($payment->status == 'not')
                                                                @if (is_null($payment->payslip))
                                                                    <a class="btn btn-sm btn-primary ml-2"
                                                                        data-toggle="modal"
                                                                        href="#pay{{ $portion->id }}">pay</a>
                                                                    <form action="/release/{{ $portion->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="">
                                                                            <button class="btn btn-danger btn-sm"
                                                                                type="submit">Release</button>
                                                                        </div>
                                                                    </form>
                                                                @else
                                                                    <span class="badge badge-info ml-2">Pending..</span>
                                                                @endif
                                                            @endif
                                                        </td>




                                                    </tr>
                                                    <div id="pay{{ $portion->id }}" class="modal fade">
                                                        @php
                                                            $payment = \App\Models\Payment::where('portion_id', $portion->id)->first();
                                                            
                                                        @endphp
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="card-title h4 mb-1"><strong><a
                                                                                href="" class="grey-text">RECEIPT
                                                                                UPLOAD</a></strong></h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Pay using the control number
                                                                        <strong>{{ $land_id->acc_num }}</strong> then
                                                                        upload your
                                                                        receipt here, it will be reviewd as soon as posiible
                                                                    </p>
                                                                    <div class="form-group">


                                                                        <form action="payslip/upload/{{ $portion->id }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="file" name="payslip"
                                                                                style="font-size:12px">
                                                                            <button class="btn btn-sm btn-primary"
                                                                                type="submit">Upload</button>
                                                                        </form>

                                                                    </div>


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
