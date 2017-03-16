<?php
namespace App\Http\Traits;

use App\Notification;
use Auth;
use Carbon\Carbon;

trait NotificationTraits {

    public function saveNotification($message, $type, $user, $ref=null) {
        // Generate new reference number
        $id = date('dmy') . rand(1000000, 9999999);
        $results = Notification::where('id', $id)->count();

        // Loop and regenerate $id while $results is more than 0
        while ($results > 0) {
            $id = date('dmy') . rand(100000, 999999);
            $results = Notification::where('id', $id)->count();
        }

        // Save notification
        Notification::create(
            [
                'id'=>$id,
                'user_id'=>$user->id,
                'message'=>$message,
                'type'=>$type,
                'reference_number'=>$ref,
                'viewed'=>false,
            ]
        );
    }
}