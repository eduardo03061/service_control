<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User as User;

class Service extends Model
{
    
    use SoftDeletes;
 
    protected $table = 'services';
 
    protected $fillable = [
        'id','name','user_id','status'
    ];
  

    public function serviceOfUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
