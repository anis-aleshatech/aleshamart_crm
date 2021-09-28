 @extends('admin.include.master')
	@section('title') Customer List - Aleshamart @endsection
@section('content')

<?php
  $permission = Auth::guard('administration')->user();
?>

<style>
	.payments{
		padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:15px;text-align:center; font-weight:bold;
	}
	.status{
		background:#006600; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center
	}
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Customer List</h3>
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
            <li class="breadcrumb-item active">Customer List</li>
          </ol>
        </div>
        @if($permission->can('customer.approval') || $permission->can('customer.delete') || $permission->can('customer.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
          @if($permission->can('customer.approval'))
            <li class=""><a  href="javascript:void()" onclick="permissions('customers','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('customers','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
          @endif
          @if($permission->can('customer.delete'))
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','customers');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
          @endif
          @if($permission->can('customer.create'))
            <li class=""><a  href="{{ route('customer.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Customer</a></li>
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
          <span class="badge badge-pill badge-secondary">{{ count($allcustomer) }}</span>
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
                @if($permission->can('customer.approval') || $permission->can('customer.delete'))
                  <th width="1%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                @endif
                  <th width="8%">Fullname</th>
                  <th width="8%">Mobile</th>
                  <th width="8%">Username</th>
                  <th width="8%">Email</th>
                  <th width="8%">Division</th>
                  <th width="8%">District</th>
                  <th width="8%">State</th>
                  {{-- <th width="2%">Verified</th> --}}
                  <th width="2%">Status</th>
                @if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail') || $permission->can('customer.login'))
                  <th width="6%" align="right">Action</th>
                @endif
                </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
              @foreach($allcustomer as $customer)
              <?php $i++;
              if($customer->status!="" && $customer->status==1){
                $statusdis = '<span style="background:#006600;" class="status"><i class="fa fa-check"></i> </span>';
              }
              else{
                $statusdis = '<span style="background:#D91021;"  class="status"><i class="fa fa-times"></i> </span>';
              }

                $divisions = App\Models\Division::where('id',$customer->division);
                if($divisions->count() > 0){
                  $divisionname = $divisions->first();
                  $divnames = $divisionname->name;
                }
                else{
                  $divnames = '';
                }

                $districts = App\Models\District::where('id',$customer->district);
                if($districts->count() > 0){
                  $districtname = $districts->first();
                  $distnames = $districtname->name;
                }
                else{
                  $distnames = '';
                }

                $areas = App\Models\Area::where('id',$customer->area);
                if($areas->count() > 0){
                  $areaname = $areas->first();
                  $areanames = $areaname->name;
                }
                else{
                  $areanames = '';
                }

              ?>

              <tr id="tablerow<?php echo $customer->id;?>" class="tablerow">
              @if($permission->can('customer.approval') || $permission->can('customer.delete'))
                <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $customer->id }}" /></td>
              @endif
                <td>{{ $customer->fullname }}</td>
                <td>{{ $customer->contact }}</td>
                <td>{{ $customer->username }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $divnames }}</td>
                <td>{{ $distnames }}</td>
                <td>{{ $areanames }}</td>
                {{-- <td>
                  @if ( $customer->verified_at != "")
                    {{  $customer->verified_at }}
                  @endif
                </td> --}}
                {{-- <td>{{ $customer->area }}</td> --}}
                <th width="2%" align="center"><?php echo $statusdis; ?></th>
                @if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail') || $permission->can('customer.login'))
                <td align="right" class="btn-group">
                  @if($permission->can('customer.edit'))
                  <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:6px 4px; margin-right: 5px;"><i class="fa fa-edit"></i></a>
                  @endif
                  @if($permission->can('customer.detail'))
                  <a href="{{ route('admin.customer.details', $customer->id) }}" class="btn btn-sm btn-info" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                  @endif
                  @if($permission->can('customer.login'))
                  <form action="{{ route('customer.login') }}" method="post" style="display:inline">
                    @csrf
                    <input type="hidden" name="username" value="{{ $customer->email }}">
                    <input type="hidden" name="password" value="{{ $customer->passwordHints }}">
                    <button type="submit" class="btn btn-sm btn-primary" style="width: 25px; font-size: 12px; float:left; padding:6px 4px; margin-right: 5px;"><i class="fa fa-user"></i></button>
                  </form>
                  @endif
                  @if($permission->can('customer.delete'))
                    <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                      onclick="deleteSingle('<?php echo $customer->id;?>','masterdelete','customers')"><i class="fa fa-trash"></i></button>
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
