<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['name','bab_id'];
    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
