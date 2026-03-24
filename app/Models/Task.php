<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
    'title',
    'completed',
    'category_id',
    'user_id'
];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //
}
