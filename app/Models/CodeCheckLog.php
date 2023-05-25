<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeCheckLog extends Model
{
    use HasFactory;
    protected $fillable = ['code_id','user_id'];

}
