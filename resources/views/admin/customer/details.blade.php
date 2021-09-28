@extends('admin.include.master')
 @section('title') Customer Details - Aleshamart @endsection
@section('content')
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
              <h3 class="page-title">Customer Detail Information</h3>
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
                  <li class="breadcrumb-item active">Customer : {{ $customer_info->fullname }}</li>
              </ol>
          </div>
          <div class="col-sm-12" style="margin:15px;">
            {{-- <div class="btn-group"> --}}
              <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">Back</a>
            @if(Auth::guard('administration')->user()->can('customer.edit'))  
              <a href="{{ route('admin.customer.edit', $customer_info->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Edit</a>
            @endif
            @if(Auth::guard('administration')->user()->can('customer.login'))
              <form action="{{ route('customer.login') }}" method="post" style="display:inline">
                @csrf
                <input type="hidden" name="username" value="{{ $customer_info->email }}">
                <input type="hidden" name="password" value="{{ $customer_info->password_hints }}">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Login</button>
              </form>
            @endif
            {{-- </div> --}}
            <a  href="{{ route('admin.customer.total_orders', [$customer_info->id]) }}" style="color:#fff; " class="btn btn-success btn-sm">Total Order</a>
            {{-- <a  href="{{ route('admin.customer.unshipped_orders', [$customer_info->id]) }}" style="color:#fff; " class="btn btn-info btn-sm">Unshipped Order</a> --}}
            <a  href="{{ route('admin.customer.complete_orders', [$customer_info->id]) }}" style="color:#fff; " class="btn btn-info btn-sm">Completed Order</a>
            <a  href="{{ route('admin.customer.canceled_orders', [$customer_info->id]) }}" style="color:#fff; " class="btn btn-danger btn-sm">Canceled Order</a>
            <a  href="{{ route('admin.customer.returned_orders', [$customer_info->id]) }}" style="color:#fff; " class="btn btn-warning btn-sm">Returned Order</a>

            {{-- <a  href="javascript:void()" onclick="sellerApproval('customers','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
            <a  href="javascript:void()" onclick="permissions('customers','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a> --}}
            {{-- <a  href="javascript:void()" onclick="sellerApproval('customers','1');" style="color:#000; " class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
            <a  href="javascript:void()" onclick="permissions('customers','0');" style="color:#000; " class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a> --}}
            <ol class="breadcrumb float-sm-right">
              {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
              <li class=""><a  href="{{ route('customer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Customer List</a></li>
          </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Profile Details </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="">Status :</th>
                  <td>
                    @if ($customer_info->status == 1)
                      Active
                    @else
                      Deactive
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="">Full Name :</th>
                  <td>{{ $customer_info->fullname }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">User Name :</th>
                  <td>{{ $customer_info->username }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Photo :</th>
                  <td>
                  @if ($customer_info->photo != "")
                    <img style="max-width: 100px;" src="{!! asset('uploads/customer/'.$customer_info->photo) !!}" alt="">
                    @else
                    Not Found!
                  @endif
                </td>
                </tr>
                <tr>
                  <th scope="row" class="">Contact :</th>
                  <td>{{ $customer_info->contact }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Email :</th>
                  <td>{{ $customer_info->email }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Password Hints :</th>
                  <td>{{ $customer_info->password_hints }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Address :</th>
                  <td>{{ $customer_info->address }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Division :</th>
                  <td>
                    @if ($customer_info->division != "")
                      {{ App\Models\Division::find($customer_info->division)->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="">District :</th>
                  <td>
                    @if ($customer_info->district != "")
                      {{ App\Models\District::find($customer_info->district)->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="">State :</th>
                  <td>
                    @if ($customer_info->area != "")
                      {{ App\Models\Area::find($customer_info->area)->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="">Zip Code :</th>
                  <td>{{ $customer_info->zipcode }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Type :</th>
                  <td>{{ $customer_info->type }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Created_at :</th>
                  <td>{{ $customer_info->created_at }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Updated_at :</th>
                  <td>{{ $customer_info->updated_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Order Details</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row" class="">Total Order :</th>
                  <td>{{ $totalOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Pending Orders :</th>
                  <td>{{ $totalPendingOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Processing Orders :</th>
                  <td>{{ $totalProcessingOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Not Reached Orders :</th>
                  <td>{{ $totalNotReachedOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Ready to Shipped Orders :</th>
                  <td>{{ $totalReadyShippedOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Shipped Orders :</th>
                  <td>{{ $totalShippedOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Picked Orders :</th>
                  <td>{{ $totalPickedOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Successfull Orders :</th>
                  <td>{{ $totalSuccessOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Canceled Orders :</th>
                  <td>{{ $totalCancelOrders }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Returned Orders :</th>
                  <td>{{ $totalReturnOrders }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div><!-- /.container-fluid -->
</section>
</div>
 
@endsection
