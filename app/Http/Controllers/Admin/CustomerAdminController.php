<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\Customer;
use App\Models\Division;
use App\Models\District;
use App\Models\Area;
use App\Models\Order;
use App\Models\Guest;
use Validator;
use Image;
use Mail;


class CustomerAdminController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth:administration');
    $this->middleware(function($request, $next) {
      $this->user = Auth::guard('administration')->user();
      return $next($request);
    });
  }

	public function index(Request $request)
  {
  	//dd($request);
    if(is_null($this->user) || !$this->user->can('customer.view')) {
      return view('admin.error.denied');
    } else {
		
		 $allcustomer = Customer::where('id', '>', 0);

		  if ($request->get('keywords')) {
			  $allcustomer = $allcustomer->where('fullname', "LIKE", "%" . $request->get('keywords') . "%")->orWhere('contact', "LIKE", "%" . $request->get('keywords') . "%")->orWhere('email', "LIKE", "%" . $request->get('keywords') . "%");
		  }
	
		  if (($request->has('from_date') && $request->get('from_date') != '') && ($request->has('to_date') && $request->get('to_date') != '')) {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $end_date = Carbon::parse($request->get('to_date'))->addDay()->format("Y-m-d");
				  $query->where(function ($query) use($request, $end_date) {
					  $query->where('created_at', '>=', $request->get('from_date'))
						  ->where('created_at', '<', $end_date);
				  })->orWhere(function ($query) use($request, $end_date) {
					  $query->where('created_at', '>=', $request->get('from_date'))
						  ->where('created_at', '<', $end_date);
				  })->orWhere(function ($query) use($request, $end_date) {
					  $query->where('created_at', '<', $request->get('from_date'))
						  ->where('created_at', '>', $end_date);
				  });
			  });
		  } elseif ($request->has('from_date') && $request->get('from_date') != '') {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $query->where(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('from_date'))
						  ->where('created_at', '>=', $request->get('from_date'));
				  })->orWhere(function ($query) use($request) {
					  $query->where('created_at', '>=', $request->get('from_date'));
				  });
			  });
		  } elseif ($request->has('to_date') && $request->get('to_date') != '') {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $query->orWhere(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('to_date'))
						  ->where('created_at', '>=', $request->get('to_date'));
				  })->orWhere(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('to_date'));
				  });
			  });
		  }
	
		  $allcustomer = $allcustomer->orderBy('id','DESC')->get();
		  return view('admin.customer.index',compact('allcustomer'));
	}
  }
	// public function guestIndex(Request $request)
  // {
	//  	$allcustomer = Guest::orderBy('id','DESC')->get();
  //   	return view('admin.customer.guest',compact('allcustomer'));
  // }

  public function create()
  {
    if(is_null($this->user) || !$this->user->can('customer.create')) {
      return view('admin.error.denied');
    } else {
      $divisions = Division::where('name','!=','')->get();
      $districts = District::where('name','!=','')->get();
      $areas = Area::where('name','!=','')->get();
      return view('admin.customer.create', compact('divisions', 'districts', 'areas'));
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('customer.create')) {
      return view('admin.error.denied');
    } else {
      $validator = Validator::make($request->all(), [
        'fullname' => 'required|string|max:255',
        'division' => 'required',
        'district' => 'required',
        'area' => 'required',
        'username' => 'required|string|max:255',
        'contact' => 'required|string|max:255|unique:customers',
        'email' => 'email|max:255|unique:customers',
        'password' => 'required|string|min:6|confirmed',
      ]);

      $m = new Customer;
      $m->fullname = $request->fullname;
      $m->username = $request->username;
      $m->address = $request->address;
      $m->division = $request->division;
      $m->district = $request->district;
      $m->area = $request->area;
      $m->zipcode = $request->zipcode;
      $m->contact = $request->contact;
      $m->email = $request->email;
      $m->password = Hash::make($request->password);
      $m->password_hints = $request->password;
      $m->status = 1;
      $m->type = 'General';
      $m->created_at = date('Y-m-d H:i:s');
      $m->updated_at = date('Y-m-d H:i:s');
      $m->save();
      return redirect('administration/customer');
    }
  }

	public function createThumbnail($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

      $img = Image::make($file);
      $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
      });

      $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		  $img->save($path);
	}

	public function show($id)
  {
    //
  }

  public function customer_edit($id)
  {
    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.edit')) {
        return view('admin.error.denied');
      } else {
        return view('admin.customer.edit',compact('customer'));
      }
    }
    else{
      abort(404);
    }
  }

  public function customer_update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
  		'fullname' => 'required|string|max:255',
  		'username' => 'required|string|max:255',
  		'contact' => 'required|string|max:255|unique:customers',
  		'email' => 'required|email|max:255',
      'password' => 'nullable|string|min:6|confirmed',
  	]);


    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.edit')) {
        return view('admin.error.denied');
      } else {
        $arrayVal = array(
          'fullname' => $request->fullname,
          'username' => $request->username,
          'contact' => $request->contact,
          'email' => $request->email,
          'address' => $request->address,
          'division' => $request->division,
          'district' => $request->district,
          'area' => $request->area,
          'zipcode' => $request->zipcode,
          'updated_at' => date('Y-m-d H:i:s'),
        );
    
        $customer->update($arrayVal);
    
        if ($request->password != "") {
          $arrayVal = array(
            'password' => Hash::make($request->password),
            'password_hints' => $request->password,
          );
          $customer->update($arrayVal);
        }
          return redirect('administration/customer')->with('success', 'Successfully Update!');
      }
    }
    else{
      abort(404);
    }
  }

  public function destroy($id)
  {
    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.delete')) {
        return view('admin.error.denied');
      } else {
        $customer->delete();
        return redirect('administration/customer');
      }
    }
    else{
      abort(404);
    }
  }

	public function searchajax(Request $req)
  {
		if($req->keywords!="")
		{
			$keywords=$req->keywords;
			$table=$req->table;
			$colid=$req->colid;
			$searchresults = DB::table($table)->where($colid, $keywords)->get();
			$displayvar = '';
			$p1 = "'lastcatid'";
			$p2 = "'subcat_id'";
			$p3 = "'lastcategories'";

			if($table =="subcategories"){
    			$displayvar .= '<select name="subcat_id" class="form-control" onchange="ajaxSearch(this.value,'.$p1.','.$p2.','.$p3.')">';
			}
			else{
			   	$displayvar .= '<select name="lastcat_id" class="form-control">';
			}
				$displayvar .= '<option value="">Select Category</option>';
    							   foreach($searchresults as $rows):
    									$displayvar .='<option value="'.$rows->id.'">'.$rows->name.'</option>';
    								endforeach;
    			$displayvar .= '</select>';
    			echo $displayvar;
		}
		else{
			echo "Null";
		}
  }

	public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
	}


	public function approvedAccount(Request $req)
  {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);


		$getSellerinfo = DB::table($tablename)->whereIn('id', $valuearray)->get();

		 foreach($getSellerinfo as $sellerinfo){
			$smails = $sellerinfo->email;
			$snames = $sellerinfo->name;
			$data = array(
					"from"=> 'support@aleshamart.com',
					"name"=> $snames,
					"to"=> $smails,
			);

			Mail::send('admin.mail.seller_account_confirm', $data, function($message) use ($data)
			{
				$message->to($data['to'], $data['name']);
				$message->subject('Hi '.$data['name'].', Welcome to Selling on aleshamart');
				$message->from($data['from'],"aleshamart");
			 });
		 }

        return redirect()->back();
  }


    public function customer_details($id)
    {
      if(is_null($this->user) || !$this->user->can('customer.detail')) {
        return view('admin.error.denied');
      } else {
        $customer_info = Customer::where('id',$id)->first();
        $totalOrders = Order::where('customer_id',$id)->count();
        $totalPendingOrders = Order::where('customer_id',$id)->where('status','Pending')->count();
        $totalProcessingOrders = Order::where('customer_id',$id)->where('status','Processing')->count();
        $totalNotReachedOrders = Order::where('customer_id',$id)->where('status','Not Reached')->count();
        $totalReadyShippedOrders = Order::where('customer_id',$id)->where('status','Ready to Shipped')->count();
        $totalShippedOrders = Order::where('customer_id',$id)->where('status','Shipped')->count();
        $totalSuccessOrders = Order::where('customer_id',$id)->where('status','Delivered')->count();
        $totalCancelOrders = Order::where('customer_id',$id)->where('status','Canceled')->count();
        $totalReturnOrders = Order::where('customer_id',$id)->where('status','Returned')->count();
        $totalPickedOrders = Order::where('customer_id',$id)->where('status','Picked')->count();
        // $totalUnshippedOrders = Order::where('customer_id',$id)->where('status','Unshipped')->count();
        return view('admin.customer.details',compact('customer_info','totalOrders','totalPendingOrders','totalProcessingOrders','totalNotReachedOrders','totalReadyShippedOrders','totalShippedOrders','totalSuccessOrders','totalCancelOrders','totalReturnOrders','totalPickedOrders'));
      }
    }
    public function total_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->get();
      return view('admin.customer.total_order',compact('customer_info','customerOrders'));
    }
    public function unshipped_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Unshipped')->get();
      return view('admin.customer.unshipped_order',compact('customer_info','customerOrders'));
    }
    public function complete_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Delivered')->get();
      return view('admin.customer.complete_order',compact('customer_info','customerOrders'));
    }
    public function canceled_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Canceled')->get();
      return view('admin.customer.canceled_order',compact('customer_info','customerOrders'));
    }
    public function returned_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Returned')->get();
      return view('admin.customer.returned_order',compact('customer_info','customerOrders'));
    }


}
