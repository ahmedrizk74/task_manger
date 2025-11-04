<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
        'phone',
        'address',
        'date_of_birth', 
        'bio',
         'image'
    ];
    // protected $guarded=['id']; //ده العكس انه ممنوع تحط فيها حاجه

  public function user(){
    return $this->belongsTo(User::class);
  }
}
