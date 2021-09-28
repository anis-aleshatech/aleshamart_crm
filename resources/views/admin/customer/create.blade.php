@extends('admin.include.master')
	@section('title') New Customer - Aleshamart @endsection
@section('content')
<style>
.required{
	color:red;
	font-size:16px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Create New Customer</h3>
                </div>
                {{-- @if (session()->has('messageType'))
                    <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                        <strong>STATUS: </strong> {{ session()->get('message') }}
                    </div>
                @endif --}}
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">New Customer</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
              <li class=""><a  href="{{ route('customer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Customer List</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Create</h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
            <table class="table table-striped projects">
                <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="fullname" class="col-md-2 col-form-label text-md-right">{{ __('Full Name') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('fullname') }}">

                            @if ($errors->has('fullname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label text-md-right">{{ __('User Name') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">

                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact" class="col-md-2 col-form-label text-md-right">{{ __('Contact') }}</label>
                        <div class="col-md-6">
                            <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}">

                            @if ($errors->has('contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <textarea id="address" type="text" class="form-control ckeditor" name="address">{{ old('address') }}</textarea>

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Division') }}</label>
                        <div class="col-md-6">
                            {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                            <select name="division" id="division_id" class="form-control">
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('division_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('division_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="district_id" class="col-md-2 col-form-label text-md-right">{{ __('District') }}</label>
                        <div class="col-md-6">
                            {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                            <select name="district" id="district_id" class="district_id form-control">
                                <option value="">Select District</option>
                                {{-- @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach --}}
                            </select>

                            @if ($errors->has('district_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('district_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="area_id" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                        <div class="col-md-6">
                            {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                            <select name="area" id="area_id" class="form-control">
                                <option value="">Select Area</option>
                                {{-- @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach --}}
                            </select>

                            @if ($errors->has('area_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="country" class="col-md-2 col-form-label text-md-right">{{ __('Country') }}</label>
                        <div class="col-md-6">
                            <select class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country">

                                @php
                                    $countries = App\Models\Country::all();
                                @endphp

                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label for="area" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                        <div class="col-md-6">
                            <select class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area">

                                @php
                                    $states = App\Models\State::all();
                                @endphp

                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('area'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}

                    {{-- <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" autofocus>

                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="zipcode" class="col-md-2 col-form-label text-md-right">{{ __('Zip Code') }}</label>
                        <div class="col-md-6">
                            <input id="zipcode" type="text" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ old('zipcode') }}" autofocus>

                            @if ($errors->has('zipcode'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="photo" class="col-md-2 col-form-label text-md-right">{{ __('Owner Photo') }}</label>

                        <div class="col-md-6">
                           <input id="photo" type="file" class="form-control" name="photo">

                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}


                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" autofocus>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" autofocus>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    
    </section>
</div>
	
@endsection

