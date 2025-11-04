<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $guarded=['id']; //ده العكس انه ممنوع تحط فيها حاج
    use HasFactory;
    public function user(){
    return $this->belongsTo(User::class);
  }
  public function categories() {
    return $this->belongsToMany(Category::class);
}
public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}

}
