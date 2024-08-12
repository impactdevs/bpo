<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'uuid'];

    // a form has one setting
    public function setting()
    {
        return $this->hasOne(FormSetting::class, 'form_id', 'uuid');
    }

    //section
    public function sections()
    {
        return $this->hasMany(Section::class, 'form_id', 'uuid');
    }
}
