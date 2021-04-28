<style>
    .filling-in-the-blank .question-x2t{
        border: none;
        border-bottom: 1px #0c0c0d dotted !important;
        text-align: center;
        outline: none;
    }
    .error-x2t{
        color: red;
    }
    .success-x2t{
        color: green;
    }
</style>
<p class="text-center">Điền đáp án vào chỗ trống </p>
<hr>
<div class="row">
    <div class="col-md-12 filling-in-the-blank">
        {!!  $question['content']  !!}
    </div>
</div>
<div id="answer-filling-in-the-blank-{{ $question['id'] }}" data-answer="{{ $question['answer'] }}"></div>
<div id="answer-answer-filling-in-the-blank-{{ $question['id'] }}" data-answer="{{ $answer }}"></div>
<script type="text/javascript">
    $( document ).ready(function() {
        $(".question-x2t-"+{{ $question['id'] }}).addClass('question-x2t');
        $(".question-x2t-"+{{ $question['id'] }}).each(function (index) {
            var question_answer = $('#answer-filling-in-the-blank-'+{{ $question['id'] }}).data('answer')[index];
            var answer = $('#answer-answer-filling-in-the-blank-'+{{ $question['id'] }}).data('answer')[index];
            $(this).val(question_answer);

            if(question_answer.toLowerCase().replaceAll(' ','') == answer.toLowerCase().replaceAll(' ','')){
                $(this).addClass('success-x2t');
            }else{
                $(this).addClass('error-x2t');
            }
        });
    });
</script>
