<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    
    use SoftDeletes;
 
    protected $table = 'roles';
 
    protected $fillable = [
        'id','Rol'
    ];
  
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
 
}
