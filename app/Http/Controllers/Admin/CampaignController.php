<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Models\Campaign;
use Validator;
use Image;
use ImageOptimizer;

class CampaignController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allcampaigns = Campaign::orderBy('id','desc')->get();
    	return view('admin.campaign.index',compact('allcampaigns'));
     }
	 
	 public function activecampaign(Request $request)
     {
	 	$allcampaigns = Campaign::where('status',1)->get();
    	return view('admin.campaign.index',compact('allcampaigns'));
     }


    public function create()
    {
        return view('admin.campaign.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);

		if ($request->hasFile('thumb')) {
            if($request->file('thumb')->isValid()) {
                try {
                    $file = $request->file('thumb');
                    $savedFileName = 'thumb_'.time() . '.' . $file->getClientOriginalExtension();
					$pathLarge = 'uploads/campaign/'.$savedFileName;

				    $this->imageResize($file,$pathLarge,$savedFileName, 300, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


		if ($request->hasFile('banner')) {
            if($request->file('banner')->isValid()) {
                try {
                    $file = $request->file('banner');
                    $savedBannerName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();
				   $pathLarge = 'uploads/campaign/cover/'.$savedBannerName;
				   $this->imageBannerResize($file,$pathLarge,$savedBannerName, 1024, null);

                }
				catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedBannerName = '';
         }
		 
		 
		$m = new Campaign;
		$m->name =  $request->name;
		$m->image =  $savedFileName;
		$m->coverphoto =  $savedBannerName;
		$m->start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
		$m->end_date = date('Y-m-d H:i:s',strtotime($request->end_date));
		$m->status =  $request->status;
		$m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/campaign');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $campaign = Campaign::find($id);
        if($campaign!=""){
            return view('admin.campaign.edit',compact('campaign'));
        }
        else{
          abort(404);
        }
    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('thumb')) {
            if($request->file('thumb')->isValid()) {
                try {
                    $file = $request->file('thumb');
                    $savedFileName = 'thumb_'.time() . '.' . $file->getClientOriginalExtension();
					$pathLarge = 'uploads/campaign/'.$savedFileName;
				    $this->imageResize($file,$pathLarge,$savedFileName, 300, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


		if ($request->hasFile('banner')) {
            if($request->file('banner')->isValid()) {
                try {
                    $file = $request->file('banner');
                    $savedBannerName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();
				   $pathLarge = 'uploads/campaign/cover/'.$savedBannerName;
				   $this->imageBannerResize($file,$pathLarge,$savedBannerName, 1024, null);

                }
				catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedBannerName = $request->stillbanner;
         }
		 
		$m = Campaign::find($id);
        if($m!=""){
            $arrayVal = array(
                'name' => $request->name,			
                'start_date' => date('Y-m-d H:i:s',strtotime($request->start_date)),
                'end_date' => date('Y-m-d H:i:s',strtotime($request->end_date)),
                'status'=>$request->status,
                'coverphoto'=>$savedBannerName,
                'image'=>$savedFileName,
                'updated_at'=>date('Y-m-d H:i:s')
            );
    
            $m->update($arrayVal);
            return redirect('administration/campaign');
        }
        else{
          abort(404);
        }
		
    }

    public function destroy($id)
    {
        $menuItem = Campaign::find($id);
        if($menuItem!=""){
            $menuItem->delete();
            return redirect('administration/campaign');
        }
        else{
          abort(404);
        }
        
    }
	
	public function imageBannerResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
		ImageOptimizer::optimize($path);
	}


	public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

		// if ($request->has('optimize')) {
			// ImageOptimizer::optimize($path);
		// }
        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
		//dd($path);
		ImageOptimizer::optimize($path);
	}


}
