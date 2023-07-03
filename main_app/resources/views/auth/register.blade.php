@extends('layouts.app')

@section('content')
    <div class="col-md-7 mt-5 pt-3 mx-auto">
        <div class="modal-dialog cascading-modal">
            <div class="modal-content animated zoomIn">
                <div class="modal-c-tabs">
                    <ul class="nav md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " href="" role="tab"><i class="fas fa-user mr-1"></i>
                                Register</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in show active" role="tabpanel">
                            <div class="modal-body mb-1">

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="md-form form-sm">
                                        <i class="fas fa-user prefix"></i>
                                        <input type="text" id="form11"
                                            class="form-control form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autocomplete="name"
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="form11">Your username</label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="text" id="form11"
                                            class="form-control form-control  @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="form11">Your email</label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="form12"
                                            class="form-control form-control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="form12">Your password</label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="password-confirm" type="password"
                                            class="form-control form-control-sm" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <label for="password-confirm">Repeat password</label>
                                    </div>

                                    <div class="text-center form-sm mt-2">
                                        <button type="submit" class="btn btn-info">Sign up <i
                                                class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>


                                </form>

                            </div>

                            <div class="modal-footer">
                                <div class="mr-auto">
                                    <p class="pt-1">Already have an account? <a href="{{ route('login') }}" class="blue-text">Log
                                            In</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
