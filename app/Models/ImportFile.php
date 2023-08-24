<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportFile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function filecode()
    {
        return $this->hasMany(FileCode::class);
    }
    public function getFileUrl()
    {
        if($this->name)
        {
            if(\Storage::disk('local')->exists("public/imported_code_files/" . $this->name)) 
            {
                return asset('storage/imported_code_files')."/".$this->name;
            }
        }
        return "";        
    }
}
