@extends('admin.include.master')
@section('title') Company Profile - Aleshamart @endsection
@section('content')
<?php
    $permission = Auth::guard('administration')->user();
?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">View Company Profile </h3>
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
                            <li class="breadcrumb-item active">Company Profile List</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-12"> --}}
                        {{-- <ol class="breadcrumb float-sm-right"> --}}
{{--                            <li class=""><a  href="javascript:void()" onclick="permissions('company_profiles','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>--}}
{{--                            <li class=""><a  href="javascript:void()" onclick="permissions('company_profiles,'0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>--}}
{{--                            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','company_profiles');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>--}}
{{--                            <li class=""><a  href="{{ route('companyprofile.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Company Profile</a></li>--}}
                        {{-- </ol> --}}
                    {{-- </div> --}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form id="form_check">
                        <table id="responsive-datatable" class="table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="13%">Company Name</th>
                                <th width="20%">Logo</th>
                                <th width="20%">Contact</th>
                                <th width="20%">Address</th>
                                <th width="20%">Email</th>
                                <th width="20%">Hotline</th>
                                <th width="20%">Google Play Link</th>
                                <th width="20%">Play Store Link</th>
                            @if($permission->can('comProfile.edit') || $permission->can('comProfile.delete'))
                                <th width="12%" align="right">Action</th>
                            @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                                <tr id="tablerow" class="tablerow">
                                    <td>{{ $company->name }}</td>
                                    <td><img src="{{ asset('uploads/companyprofile/'.$company->logo) }}" style="width:120px; height:auto" /></td>
                                    <td>{{ $company->contact }}</td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->hotline }}</td>
                                    <td>{{ $company->google_play_link }}</td>
                                    <td>{{ $company->play_store_link }}</td>
                                    @if($permission->can('comProfile.edit') || $permission->can('comProfile.delete'))
                                    <td align="right">
                                        <div class="btn-group">
                                        @if($permission->can('comProfile.edit'))
                                            <a href="{{ route('companyprofile.edit', $company->id) }}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:3px 5px">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        @endif
{{--                                            <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; float:left; padding:3px 5px"--}}
{{--                                                    onclick="deleteSingle('<?php //echo $company->id;?>','masterdelete','brands')"><i class="fa fa-trash"></i> Delete</button>--}}
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection

