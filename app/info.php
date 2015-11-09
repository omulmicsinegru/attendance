<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class info extends Model {
        
       protected $table = 'info';    
    
        protected $fillable = ['notes','ot_hours','created_at','updated_at'];
}
