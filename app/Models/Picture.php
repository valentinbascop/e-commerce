<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'filename'];

    protected static function booted()
    {
        static::deleting(function (Picture $picture) {
            Storage::disk('public')->delete($picture->filename);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrl()
    {
        return Storage::disk('public')->url($this->filename);
    }
}
