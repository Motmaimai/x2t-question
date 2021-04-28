<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Answer;

/**
 * Class AnswerTransformer.
 *
 * @package namespace App\Transformers;
 */
class AnswerTransformer extends TransformerAbstract
{
    /**
     * Transform the Answer entity.
     *
     * @param \App\Models\Answer $model
     *
     * @return array
     */
    public function transform(Answer $model)
    {
        return [
            'id'         => (int) $model->id,
            'question_id'=> (int) $model->question_id,
            'question'   => (object) $model->question,
            'answer'     => (string) $model->answer,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
