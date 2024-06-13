<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['is_group', 'name', 'avatar', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
