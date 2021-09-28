@extends('admin.include.master')
@section('title') Notification List - Aleshamart @endsection
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
                            <h3 class="page-title">View Notification List</h3>
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
                            <li class="breadcrumb-item active">Notification List</li>
                        </ol>
                    </div>
                    @if($permission->can('notification.approval') || $permission->can('notification.delete') || $permission->can('notification.create'))
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                        @if($permission->can('notification.approval'))
                            <li class=""><a  href="javascript:void()" onclick="permissions('news','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
                            <li class=""><a  href="javascript:void()" onclick="permissions('news','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
                        @endif
                        @if($permission->can('notification.delete'))
                            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','news');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
                        @endif
                        @if($permission->can('notification.create'))
                            <li class=""><a  href="{{ route('admin.create.notification') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Notification</a></li>
                        @endif
                        </ol>
                    </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total List
                        <span class="badge badge-pill badge-secondary">{{ count($notifications) }}</span>
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form id="form_check">
                        <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                @if($permission->can('notification.approval') || $permission->can('notification.delete'))
                                <th width="5%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                @endif
                                <th width="10%">Type </th>
                                <th width="40%">Headline </th>
                                <th width="10%">File</th>
                                <th width="10%">Read status</th>
                                <th width="5%">Status</th>
                                @if($permission->can('notification.edit') || $permission->can('notification.delete'))
                                <th width="10%" align="right">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($notifications as $notification)
                                <?php $i++;
                               
                                ?>

                                <tr id="tablerow<?php echo $notification->id;?>" class="tablerow">
                                    @if($permission->can('notification.approval') || $permission->can('notification.delete'))
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $notification->id }}" /></td>
                                    @endif
                                    {{-- <td align="center" valign="top"><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $notification->id }}" /></td> --}}
                                    <td align="center" valign="top">{{ $notification->notificationTypes->name }}</td>
                                    <td align="center" valign="top">{{ $notification->usersType->name }}</td>
                                    <td align="center" valign="top">{!! Str::limit($notification->details,40) !!}</td>
                                    <td align="center" valign="top">@if($notification->image!="")<a href="{{ asset('uploads/notification/'.$notification->image) }}" target="_blank" style="text-align:center; color:#fff">
                                            <img src="{{ asset('uploads/notification/'.$notification->image) }}" style="width:100px; height:100px" /></a>@endif</td>

                                    <td><b>@if($notification->read_status == 1) <button class="btn btn-success">Active</button> @else <button class="btn btn-warning">Inactive</button>  @endif</td>
                                    <td><b>@if($notification->status == 1) <button class="btn btn-success">Active</button> @else <button class="btn btn-warning">Inactive</button>  @endif</td>
                                    @if($permission->can('notification.edit') || $permission->can('notification.delete'))
                                    <td align="center" valign="top">
                                    @if($permission->can('notification.edit'))
                                        <div style="width:50%; float:left">
                                            <a href="{{ route('notification.edit', $notification->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>                              
                                        </div>
                                    @endif
                                    @if($permission->can('notification.delete'))
                                        <div style="width:50%; float:left">
                                            <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $notification->id;?>','masterdelete','news')"><i class="fa fa-trash"></i></button>
                                        </div>
                                    @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
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
