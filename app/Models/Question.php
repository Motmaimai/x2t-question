<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Question.
 *
 * @package namespace App\Models;
 */
class Question extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'questions';
    protected $primaryKey ='id';
    protected $fillable = [
        'unit_id','category_id','title','content','answer','order_by','status','question_child'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
