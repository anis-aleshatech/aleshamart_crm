<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('comProfile.view')) {
            return view('admin.error.denied');
        } else {
            $company = CompanyProfile::first();
            return view('admin.company_profile.index',compact('company'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        return view('admin.company_profile.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'logo' => 'required|image'
//        ]);
//
//
//        if ($request->hasFile('logo')) {
//            if($request->file('logo')->isValid()) {
//                try {
//                    $file = $request->file('logo');
//                    $savedFileName = 'logo_'.time() . '.' . $file->getClientOriginalExtension();
//                    //$request->file('thumb')->move("uploads/category/", $savedFileName);
//
//                    $pathLarge = 'uploads/companyprofile/'.$savedFileName;
//                    $pathToOptimizedImage = 'uploads/companyprofile/opt/'.$savedFileName;
//
//
//                    $this->imageResize($file,$pathLarge,$savedFileName, 90, 90);
//
//                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//                }
//            }
//        }
//        else{
//            $savedFileName = '';
//        }
//
//         $cp = new CompanyProfile();
//        $cp->name = $request->name;
//        $cp->contact = $request->contact;
//        $cp->hotline = $request->hotline;
//        $cp->address = $request->address;
//        $cp->email = $request->email;
//        $cp->google_play_link = $request->google_play_link;
//        $cp->play_store_link = $request->play_store_link;
//        $cp->logo = $savedFileName;
//        $cp->created_at = date('Y-m-d H:i:s');
//        $cp->updated_at = date('Y-m-d H:i:s');
//        $cp->save();
//        return redirect('administration/companyprofile');
//
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = CompanyProfile::find($id);
        if($company!=""){
            if(is_null($this->user) || !$this->user->can('comProfile.edit')) {
                return view('admin.error.denied');
            } else {
                return view('admin.company_profile.edit',compact('company'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'logo' => 'required|image'
        ]);

        // dd($request->all());

        if ($request->hasFile('logo')) {
            if($request->file('logo')->isValid()) {
                try {
                    $file = $request->file('logo');
                    $savedFileName = 'logo_'.time() . '.' . $file->getClientOriginalExtension();
                    //$request->file('thumb')->move("uploads/category/", $savedFileName);

                    $pathLarge = 'uploads/companyprofile/'.$savedFileName;
                    $this->imageResize($file,$pathLarge,$savedFileName, 90, 90);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedFileName = $request->logo;
        }

        $company = CompanyProfile::find($id);
        if($company!=""){
            if(is_null($this->user) || !$this->user->can('comProfile.edit')) {
                return view('admin.error.denied');
            } else {
                $companyUpdate = array(
                    'name'=> $request->name,
                    'contact'=> $request->contact,
                    'hotline'=> $request->hotline,
                    'address'=> $request->address,
                    'email'=> $request->email,
                    'play_store_link'=> $request->play_store_link,
                    'google_play_link'=> $request->google_play_link,
                    'logo'=> $savedFileName,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                );

                $company->update($companyUpdate);
                return redirect('administration/companyprofile');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        $companyItem = CompanyProfile::find($id);
//        $companyItem->delete();
//        return redirect('administration/companyprofile');
//    }

    public function imageResize($file, $path, $filename, $width, $height)
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
}
