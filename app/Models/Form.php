<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'uuid'];

    // a form has many fields
    public function fields()
    {
        return $this->hasMany(FormField::class, 'form_id', 'uuid');
    }

    // a form has one setting
    public function setting()
    {
        return $this->hasOne(FormSetting::class, 'form_id', 'uuid');
    }
}
