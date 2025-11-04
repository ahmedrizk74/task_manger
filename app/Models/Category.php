<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    use HasFactory;
        protected $guarded=['id']; //ده العكس انه ممنوع تحط فيها حاجه
    public function tasks() {
    return $this->belongsToMany(Task::class);
}
}
