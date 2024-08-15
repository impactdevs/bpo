<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'label', 'type', 'options'];

    // each form field can have 0 or more properties
    public function properties()
    {
        return $this->hasMany(condition::class, 'field_id');
    }
}
