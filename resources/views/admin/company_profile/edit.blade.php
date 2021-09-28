@extends('admin.include.master')
@section('title') Edit - {{ $company->name }} - Aleshamart @endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">Company Information Edit</h3>
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
                            <li class="breadcrumb-item active">Edit - {{ $company->name }}</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('companyprofile.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i>Company Profile</a></li>
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
                    <table class="table table-responsive table-striped projects">
                        {!! Form::model($company, ['route'=>['companyprofile.update', $company->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Company Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $company->name }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <img style="width:120px; height:auto" id="selectImage0" src="{{ asset('uploads/companyprofile/'.$company->logo) }}">
                                <input id="image" type="file" style="font-size:10px;" name="logo" onchange="readURL('0',this,'selectImage')">
                                <input type="hidden" name="logo" value="{{ $company->logo }}"/>
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                                @endif
                            </div>
{{--                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Logo') }}</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input id="image" type="file" class="form-control" name="logo" >--}}
{{--                                @if ($errors->has('logo'))--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('logo') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Contact') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ $company->contact }}" required>
                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Hotline') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="hotline" value="{{ $company->hotline }}" required>
                                @if ($errors->has('hotline'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hotline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="email" class="form-control" name="email" value="{{ $company->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Google Play Link') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="google_play_link" value="{{ $company->google_play_link }}" required>
                                @if ($errors->has('google_play_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('google_play_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Play Store Link') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="play_store_link" value="{{ $company->play_store_link }}" required>
                                @if ($errors->has('play_store_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('play_store_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <textarea name="address" class="form-control ckeditor">{{ $company->address }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
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
                        {!! Form::close() !!}
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>

@endsection

