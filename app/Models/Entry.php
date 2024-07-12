<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'responses', 'user_id'];

    // an entry belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // an entry belongs to a form
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id', 'uuid');
    }
}
