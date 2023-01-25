<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $table = 'attachments';
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'is_public'
    ];

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
