<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
        'folder_name',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function files()
    {
        return $this->hasMany(File::class, 'folder_id');
    }

}