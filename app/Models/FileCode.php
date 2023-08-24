<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCode extends Model
{
    use HasFactory;
    public function importfile()
    {
        return $this->belongsTo(ImportFile::class);
    }
}
