<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'image'
    ];

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    public function attachFiles(?array $files): void{

        if ($files === null || empty($files)) {
            return;
        }
        $pictures = [];
        foreach($files as $file){
            if($file->getError()){
                continue;
            }
            $filename = $file->store('products/' . $this->id, 'public');
            $pictures[] = [
                'filename' => $filename 
            ];
        } 
        if (count($pictures) > 0){
            $this->pictures()->createMany($pictures);
        }
    }

    public function getPicture(): ?Picture{
        return $this->pictures[0] ?? null;
    }
}
