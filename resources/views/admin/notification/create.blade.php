@extends('admin.include.master')
@section('title') New Notification - aleshamart @endsection
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
                            <h3 class="page-title">Create New Notification</h3>
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
                            <li class="breadcrumb-item active">New Notification</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('notification.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Notification List</a></li>
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
                        
                        <form method="POST" action="{{ route('notification.store') }}" enctype="multipart/form-data">
                            @csrf
                        

                            <div id="user_area">
                           
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Sender') }}</label>
                                <div class="col-md-6">
                                    {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                                    <select name="user_id" class="form-control" id="user" required>
                                        <option value="">---Select User ---</option>
                                        @foreach($users as $user)
                                        @if($user->name != null)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @else
                                                <option selected disabled value="0">There have no User</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('user'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Notification Type') }}</label>
                                <div class="col-md-6">
                                    {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                                    <select name="topic_type" class="form-control" id="topic_type" required>
                                        <option value="">---Select Notification Type ---</option>
                                        @foreach($notificationTypes as $notificationType)
                                        @if($notificationType->name != null)
                                                <option value="{{$notificationType->id}}">{{$notificationType->name}}</option>
                                            @else
                                                <option selected disabled value="0">There have no notificationtype</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('topic_type'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('topic_type') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Message Body') }}</label>
                                <div class="col-md-6">
                                    <textarea name="details" id="details" cols="30" rows="10" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" autofocus required></textarea>
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    


        $(document).ready(function() {
            var templateType = $('#topic_type');
            templateType.change(function() {
                var templateTypeValue = $('#topic_type').val();
                let data={
                    id:templateTypeValue
                };
                axios.post("{{route('notification.template.ajax')}}", data)
                .then(function (response) {
                    if (response.data.message) {
                        $('#message').val(response.data.message)
                    }else{
                        $('#message').attr("placeholder", "Data is not Available....");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
      

            });
        });

        $(document).ready(function() {
            $('#user').select2();
        });


        </script>

@endsection

