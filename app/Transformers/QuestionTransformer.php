<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;
use App\Models\Question;

/**
 * Class QuestionTransformer.
 *
 * @package namespace App\Transformers;
 */
class QuestionTransformer extends TransformerAbstract
{
    /**
     * Transform the Question entity.
     *
     * @param \App\Models\Question $model
     *
     * @return array
     */
    public function transform(Question $model)
    {
        return [
            'id'         => (int) $model->id,
            'title'      => (string) $model->title,
            'content'    => (string) $model->content,
            'answer'     => (string) $model->answer,
            'unit_id'    => (int) $model->unit_id,
            'category_id'=> (int) $model->category_id,
            'order_by'=> (int) $model->order_by,
            'category'   => (object) $model->category,
            'question_child'=> (string) $model->question_child,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
