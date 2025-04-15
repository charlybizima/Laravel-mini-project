<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'description',
        'file_path',
        'cover_image',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function isAvailable()
    {
        return !$this->borrowings()->whereNull('returned_at')->exists();
    }
} 