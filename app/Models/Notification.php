<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

      public static $notificationType = [
        1 => 'Message',
        2 => 'Chat',
    ];
}
