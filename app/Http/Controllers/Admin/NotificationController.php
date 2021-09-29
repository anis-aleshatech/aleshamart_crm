<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer; 
use App\Models\Notification;
use App\Models\NotificationsType;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Models\UsersType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Intervention\Image\Facades\Image;
use App\Helpers\Helper;
class NotificationController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    public function indexNotification() {
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notifications = Notification::with('users')->get();
            return view('admin.notification.index',compact('notifications'));
        }
    }

    public function createNotification() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $users = User::all();
            $notificationTypes = NotificationsType::all();
            return view('admin.notification.create',compact('notificationTypes','users'));
        }
    }

    public function storeNotification (Request $request)
    {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $validator = Validator::make($request->all(), [
                'topic_type' => 'required',
                'user_id' => 'required',
                'details' => 'required|string',
            ]);
       
            
            $user=User::find($request->user_id);
            $notification = new Notification();
            $notification->user_id      = $user->id;
            $notification->name      = $user->name;
            $notification->phone      = $user->phone;
            $notification->topic_type   = $request->topic_type;
            $notification->details      = $request->details;
            $result=$notification->save();
          
            if($result){
                $otp=Helper::sendSMS( '88'.$user->phone, $request->details, 1);
                return  redirect()->route('notification.index')->with('success', 'SMS Send Successfully !');
            }else{

                return  redirect()->back()->with('error', 'Something Wrong.. !');
            }
        }
    }
    public function notificationEdit($id) {
        $notification = Notification::find($id);
        if($notification!=""){
            if(is_null($this->user) || !$this->user->can('notification.edit')) {
                return view('admin.error.denied');
            } else {
            $customers = Customer::all();
            $userTypes = UsersType::where('status', 1)->get();
            $notificationTypes = NotificationsType::where('status', 1)->get();
            return view('admin.notification.notification-edit',compact('notification','userTypes','notificationTypes','customers'));
            }
        }else{
            abort(404);
        }
    }
    public function notificationUserUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            // 'image' => ['required|image']
        ]);
        $notification = Notification::find($request->id);
        if($notification!=""){
            if(is_null($this->user) || !$this->user->can('notification.edit')) {
                return view('admin.error.denied');
            } else {
                $fileImage = $request->file('image');
                if($fileImage && $request->user_id && $request->merchant_id) {
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->image        = $savePhotos;

                }
                elseif($fileImage && $request->user_id) {
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }

                    $notification->user_id      = $request->user_id;
                    $notification->image        = $savePhotos;

                }
                elseif($fileImage && $request->merchant_id){
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->image        = $savePhotos;
                }
                elseif($request->user_id && $request->merchant_id){

                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                }
                elseif($fileImage){
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }

                    $notification->image        = $savePhotos;

                }
                elseif($request->user_id){
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->user_id      = $request->user_id;
                }
                elseif($request->merchant_id){
                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                }
                $notification->user_type    = $request->user_type;
                $notification->topic_type   = $request->topic_type;
                $notification->details      = $request->details;
                $notification->status       = $request->status;
                $notification->save();

                return redirect()->route('notification.index')->with('success', 'Update Successfully !');;
            }
        } else {
            abort(404);
        }
    }





    /*
     *
     * Notification types
     * this method use for crate notification type
     *
     *
     * */


    public function notificationType() {
        $notificationsTypes = NotificationsType::all();
        return view('admin.notification.notification-type',compact('notificationsTypes'));
    }




    public function createNotificationType() {
        return view('admin.notification.create-notification-type');
    }





    public function notificationTypeStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $notificationType = new NotificationsType();
        $notificationType->name     = $request->name;
        $notificationType->save();
        return redirect('administration/notification/type')->with('success', 'Created Successfully !');;
    }





    public function notificationTypeEdit($id) {
        $notificationType = NotificationsType::find($id);
        return view('admin.notification.notification-type-edit',compact('notificationType'));
    }



    public function notificationTypeUpdate(Request $request) {
        NotificationsType::notificationTypeUpdateData($request);
        return redirect()->route('notification.type')->with('success', 'Update Successfully !');;
    }






    /*
     *
     * Notification Template types
     * this method use for crate notification type
     *
     *
     * */


    public function notificationTemplate() {
        $notificationTemplates = NotificationTemplate::with('notificationsTypes')->get();
        return view('admin.notification.notificationTemplate',compact('notificationTemplates'));
    }


    public function createNotificationTemplate() {
        $notificationsTypes = NotificationsType::all();
        return view('admin.notification.create-notification-template', compact('notificationsTypes'));
    }





    public function notificationTemplateStore(Request $request) {
       
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'notification-template' => 'required|number',
        ]);
        $notificationType = new NotificationTemplate();
        $notificationType->message     = $request->message;
        $notificationType->notifications_type_id     = $request->nt_id;
        $notificationType->save();
        return redirect('administration/notification/template')->with('success', 'Created Successfully !');;
    }





    public function notificationTemplateEdit($id) {
        $notificationTemplate = NotificationTemplate::find($id);
        $notificationsTypes = NotificationsType::all();
        return view('admin.notification.notification-template-edit',compact('notificationTemplate', 'notificationsTypes'));
    }



    public function notificationTemplateUpdate(Request $request) {
    
        NotificationTemplate::notificationTemplateUpdateData($request);
        return redirect()->route('notification.template')->with('success', 'Update Successfully !');;
    }



    /*
     * notification user type function
     *
     * */

    public function notificationUserType() {
        $allnews = UsersType::all();
        return view('admin.notification.notification-user-type',compact('allnews'));
    }
    public function notificationUserTypeCreate() {
        return view('admin.notification.notification-user-type-create');
    }
    public function notificationUserTypeStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $userType = new UsersType();
        $userType->name = $request->name;
        $userType->status = $request->status;
        $userType->save();
        return redirect()->route('notification.user.type')->with('success', 'Create Successfully !');;
    }
    public function notificationUserTypeEdit($id) {
        $userType = UsersType::find($id);
        return view('admin.notification.notification-user-type-edit',compact('userType'));
    }
    public function notificationUserTypeUpdate(Request $request) {
        UsersType::notificationUserTypeUpdateData($request);
        return redirect()->route('notification.user.type')->with('success', 'Update Successfully !');;
    }
    public function notificationUserTypeDelete($id) {
        // dd($id);
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



    public function notificationTypeAjax(Request $request) {
        $notificationsTypes = NotificationTemplate::where('notifications_type_id', $request->id)->select('message')->first();
        return response()->json($notificationsTypes);
    }

}
