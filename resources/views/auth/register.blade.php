@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- email address -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone number -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">Age*</label>
                            <div class="col-md-6">
                              <input id="age" type="number" class="form-control" name="age" min="1" value="{{old('age')}}"/>
                              @if ($errors->has('age'))
                                  <span class="text-danger">{{ $errors->first('age') }}</span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="blood" class="col-md-4 col-form-label text-md-right">Blood Group*</label>
                            <div class="col-sm-6">
                              <select class="custom-select" name="blood">
                                <option selected disabled value="0">Select Blood Group</option>
                                  <option value="1">A+</option>
                                  <option value="2">A-</option>
                                  <option value="3">B+</option>
                                  <option value="4">B-</option>
                                  <option value="5">AB+</option>
                                  <option value="6">AB-</option>
                                  <option value="7">O+</option>
                                  <option value="8">O-</option>
                              </select>
                              @if ($errors->has('blood'))
                                  <span class="text-danger">{{ $errors->first('blood') }}</span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender*</label>
                            <div class="col-sm-6">
                              <select class="custom-select" name="gender">
                                <option selected disabled value="0">Select Gender</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                              </select>
                              @if ($errors->has('gender'))
                                  <span class="text-danger">{{ $errors->first('gender') }}</span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">NID Number*</label>
                            <div class="col-sm-6">
                              <input id="nid" type="text" class="form-control" name="nid" min="1"  value="{{old('nid')}}"/>
                              @if ($errors->has('nid'))
                                  <span class="text-danger">{{ $errors->first('nid') }}</span>
                              @endif
                            </div>
                          </div>

                        <!-- password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- confirm password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
