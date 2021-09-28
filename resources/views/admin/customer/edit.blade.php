@extends('admin.include.master')
	@section('title') Edit Customer - Aleshamart @endsection
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
                <h3 class="page-title">Customer Information Edit</h3>
                </div>
                @if (session()->has('messageType'))
                    <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                        <strong>STATUS: </strong> {{ session()->get('message') }}
                    </div>
                @endif
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Edit Customer - {{ $customer->fullname }}</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
            @if(Auth::guard('administration')->user()->can('customer.detail'))
                <li>
                    <a  href="{{ route('admin.customer.details', $customer->id) }}" style="color: #fff; margin-right:20px" class="btn btn-warning btn-sm"><i class="fa fa-info"></i> {{ $customer->fullname }}</a>
                </li>
            @endif
                {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                <li class=""><a  href="{{ route('customer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Customer List</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit </h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
            <table class="table table-striped projects">
                <form method="POST" action="{{ route('admin.customer.update', $customer->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="fullname" class="col-md-2 col-form-label text-md-right">{{ __('Full Name') }}<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ $customer->fullname }}" required autofocus>

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
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $customer->username }}" required autofocus>

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
                                <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ $customer->contact }}" autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $customer->email }}" required>

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
                                <textarea id="address" type="text" class="form-control ckeditor" name="address" required autofocus>{{ $customer->address }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						{{-- <div class="form-group row">
                            <label for="division" class="col-md-2 col-form-label text-md-right">{{ __('Division') }}</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('division') ? ' is-invalid' : '' }}" name="division">

																	@php
																		$divisions = App\Models\Division::all();
																	@endphp
																	@if ($customer->division != "")
																		<option value="{{ $customer->division }}">
																			{{ App\Models\Division::find($customer->division)->name }}
																		</option>
																		@else
																			<option value="">Select Division</option>
																	@endif
																	@foreach ($divisions as $division)
																		<option value="{{ $division->id }}">{{ $division->name }}</option>
																	@endforeach
                                </select>

                                @if ($errors->has('division'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('division') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-md-2 col-form-label text-md-right">{{ __('District') }}</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district">

                                                                    @php
                                                                        $districts = App\Models\District::all();
                                                                    @endphp
                                                                    @if ($customer->district != "")
                                                                        <option value="{{ $customer->district }}">
                                                                            {{ App\Models\District::find($customer->district)->name }}
                                                                        </option>
                                                                        @else
                                                                            <option value="">Select District</option>
                                                                    @endif
                                                                    @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                                    @endforeach
                                </select>

                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="area" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area">

									@php
									    $states = App\Models\Area::all();
									@endphp

                                    @if ($customer->area != "")

                                        <option value="{{ $customer->area }}" selected>{{ App\Models\Area::find($customer->area)->name }}</option>
                                    @endif

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
                        <div class="form-group row">
                            <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Division') }}</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division" id="division_id">

                                    @php
                                        $divisions = App\Models\Division::all();
                                    @endphp
                                    @if ($customer->division != "")
                                        <option value="{{ $customer->division }}">
                                            {{ App\Models\Division::find($customer->division)->name }}
                                        </option>
                                    @else
                                        <option value="">Select Division</option>
                                    @endif

                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('division'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('division') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district_id" class="col-md-2 col-form-label text-md-right">{{ __('District') }}</label>
                            <div class="col-md-6">
                                <select class="district_id form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}" name="district" id="district_id">

                                    @php
                                        $districts = App\Models\District::all();
                                    @endphp
                                    @if ($customer->district != "")
                                        <option value="{{ $customer->district }}">
                                            {{ App\Models\District::find($customer->district)->name }}
                                        </option>
                                    @else
                                        <option value="">Select District</option>
                                    @endif
                                    {{-- @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach --}}
                                </select>

                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area_id" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                <select class="area_id form-control{{ $errors->has('area_id') ? ' is-invalid' : '' }}" name="area" id="area_id">

                                    @php
                                        $areas = App\Models\Area::all();
                                    @endphp
                                    @if ($customer->area != "")
                                        <option value="{{ $customer->area }}">
                                            {{ App\Models\Area::find($customer->area)->name }}
                                        </option>
                                    @else
                                        <option value="">Select State</option>
                                    @endif
                                    {{-- @foreach ($areas as $area)
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
                            <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $customer->city }}" autofocus>

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
                                <input id="zipcode" type="text" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ $customer->zipcode }}" autofocus>

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
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" >

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
                                    {{ __('Update') }}
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
