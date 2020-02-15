<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code','name','category_id','descryption','price','stock','photo'];

    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
