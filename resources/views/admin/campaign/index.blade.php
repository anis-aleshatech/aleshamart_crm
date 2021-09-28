@extends('admin.include.master')
	@section('title') Campaign List - Aleshamart @endsection
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Campaign List</h3>
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
            <li class="breadcrumb-item active">Campaign List</li>
          </ol>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class=""><a  href="javascript:void()" onclick="permissions('campaigns','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('campaigns','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','campaigns');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            <li class=""><a  href="{{ route('campaign.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Campaign</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Total List
          <span class="badge badge-pill badge-secondary">{{ count($allcampaigns) }}</span>
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
                <th width="1%">SI</th>
                <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" /></th>
                <th>Campaign Name</th>
                <th>Start time</th>
                <th>End time</th>                                        
                <th>Thumb</th>
                <th>Cover Photo</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($allcampaigns as $cu):
                $id=$cu->id;
                $name=$cu->name;
                $start_date=$cu->start_date;
                $end_date=$cu->end_date;
                $image=$cu->image;
                $coverphoto=$cu->coverphoto;
                $i++;
                
                if($cu->status!="" && $cu->status==1){
                  $statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center">
                  <i class="fa fa-check"></i> </span>';
                }
                else{
                  $statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center">
                  <i class="fa fa-times"></i> </span>';
                }
                ?>
              <tr id="tablerow<?php echo $id;?>" class="tablerow">
                <td><?php echo $i;?></td>
                <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="<?php echo $id;?>" /></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $start_date; ?></td>
                <td><?php echo $end_date; ?></td>
                <td>
                @if (isset($cu->image))
                  <img src="{{ asset('uploads/campaign/'.$cu->image) }}" style="width:40px; height:auto" />
                @endif
                </td>
                <td>
                @if (isset($cu->coverphoto))
                  <img src="{{ asset('uploads/campaign/cover/'.$cu->coverphoto) }}" style="width:100px; height:auto" />
                @endif
                </td>
                <th width="10%" align="center"><?php echo $statusdis; ?></th>
                <td> 
                   <a href="{{ route('campaign.edit', $id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span> Edit</a> 
                    <button type="button" class="btn btn-danger  btn-sm" onclick="deleteSingle('<?php echo $id;?>','masterdelete','campaigns')"><i class="fa fa-trash"></i> Delete</button>
                </td>
              </tr>
              <?php
                endforeach;
              ?>  
              
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
