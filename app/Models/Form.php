<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FormTip;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [

        'full_name', 'number','email','intervals','mail','count','note','r_id','game_id','facebook_name'

    ];
    
    public function tips(){
        return $this->hasMany(FormTip::class,'form_id','id');
    }
}
