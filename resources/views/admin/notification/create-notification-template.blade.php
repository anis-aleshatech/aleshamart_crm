@extends('admin.include.master')
@section('title') New Notification Template - aleshamart @endsection
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
                            <h3 class="page-title">Create New Notification Template</h3>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>STATUS: </strong> {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">New Notification Template</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('notification.type') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Notification Template List</a></li>
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
                        <form method="POST" action="{{ route('notification.template.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div id="nt_area">
                                <div class="form-group row">
                                    <label for="" class="col-md-2 col-form-label text-md-right">{{ __('Notification Type') }}</label>
                                    <div class="col-md-6">
                                        <select name="nt_id" class="form-control" required>
                                            <option value="">---Select Notification Type ---</option>
                                            @foreach($notificationsTypes as $notificationsType)
                                                @if($notificationsType->name != null)
                                                    <option value="{{$notificationsType->id}}">{{$notificationsType->name}}</option>
                                                @else
                                                    <option selected disabled value="0">There have no notification type</option>
                                                @endif
                                            @endforeach
                                        </select>
                                            @if ($errors->has('notification-template'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('notification-template') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-md-2 col-form-label text-md-right">{{ __('Notification Message') }}</label>
                                <div class="col-md-6">
                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" autofocus required></textarea>
                                     
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('message') }}</strong>
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


