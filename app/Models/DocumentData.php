<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentData extends Model
{
    use HasFactory;

    protected $fillable = ['document_name', 'name', 'company', 'email', 'contact', 'location', 'position', 'employer', 'office_number', 'document_id'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
