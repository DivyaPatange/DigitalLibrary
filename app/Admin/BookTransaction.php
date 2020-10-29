<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class BookTransaction extends Model
{
    protected $table = "book_transactions";

    protected $fillable = ['BT_no'];
    
    public function users_name(){
        return $this->belongsTo('App\Admin\StudentBT','BT_no', 'id');
    }
}
