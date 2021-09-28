<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','user_type','topic_type', 'details','image','status'];

    public function usersType()
    {
        return $this->belongsTo(UsersType::class, 'user_type');
    }
    public function notificationTypes() {
        return $this->belongsTo(NotificationsType::class,'topic_type');
    }
    public static function notificationUserUpdateData($request) {
        $notification = Notification::find($request->id);
        $notificationImage = $request->file('image');
        if ($notificationImage){
            unlink($notification->blog_image);
        }
    }
}
