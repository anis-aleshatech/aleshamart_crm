<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationTemplate extends Model
{
    use HasFactory, SoftDeletes;

    public function notificationsTypes()
    {
        return $this->belongsTo(NotificationsType::class, 'notifications_type_id', 'id');
    }

    public static function notificationTemplateUpdateData($request){
        $NotificationTemplate = NotificationTemplate::find($request->id);
        $NotificationTemplate->message = $request->message;
        $NotificationTemplate->notifications_type_id = $request->nt_id;
        $NotificationTemplate->save();
    }


}
