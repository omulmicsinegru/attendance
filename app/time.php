<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class time extends Model {

	   protected $table = 'time';
    
        protected $fillable = ['departed','ID','created_at','arrived',];

}
