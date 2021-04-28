<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Answer.
 *
 * @package namespace App\Models;
 */
class Answer extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'question_id','answer','unit_id','user_id'
    ];
    public function question(){
        return $this->hasOne(Question::class,'id','question_id');
    }
}
