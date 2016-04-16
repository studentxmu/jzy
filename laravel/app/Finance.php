<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Catagory', 'cate_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo('App\Car', 'car_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'trans_id', 'id');
    }

}
