<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Unit.
 *
 * @package namespace App\Models;
 */
class Unit extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status'
    ];
    public function questions(){
        return $this->hasMany(Question::class,'unit_id','id');
    }
}
