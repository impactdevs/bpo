<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'responses', 'user_id'];
    protected $appends = ['title', 'subtitle'];


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

    // Keep your existing accessors, but add this scope


public function getTitleAttribute()
{
    if (!$this->form->setting) return '';
    
    $titleKey = $this->form->setting->title;
    $responses = json_decode($this->responses, true);
    return $responses[$titleKey] ?? '';
}

public function getSubtitleAttribute()
{
    if (!$this->form->setting) return '';
    
    $subtitleKey = $this->form->setting->subtitle;
    $responses = json_decode($this->responses, true);
    return $responses[$subtitleKey] ?? '';
}
}
