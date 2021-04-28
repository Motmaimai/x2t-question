<style>
    .error-x2t{
        color: red;
    }
    .success-x2t{
        color: green;
    }
</style>
<input type="hidden" name="question[true-and-false-questions][]" value="{{ $question['id'] }}">
<p class="text-center">Trả lời đáp án True False </p>
<hr>
<div class="row">
    <div class="col-md-12">
        {!!  $question['content']  !!}
    </div>
</div>
<hr>

@foreach(json_decode($question['question_child']) as $index => $value)
    <div class="row">
        <div class="col-md-8">
            <span class="h5">Câu {{ $index }} : </span>{{ $value }}
        </div>
        <div class="col-md-4">
            <input type="checkbox" data-reverse value="true" name="true-and-false-questions[{{$question['id']}}][{{$index}}]">
        </div>
    </div>
    <hr>
@endforeach
<div id="true-and-false-questions-{{ $question['id'] }}" data-answer="{{ $question['answer'] }}"></div>
<div id="answer-true-and-false-questions-{{ $question['id'] }}" data-answer="{{ $answer }}"></div>
<script type="text/javascript">
    $(function() {
        $('input[type="checkbox"]').checkboxpicker();
        var answer = $('#answer-true-and-false-questions-'+{{ $question['id'] }}).data('answer');
        $.each(answer , function( index, value ) {
            var question_answer = $('#true-and-false-questions-'+{{ $question['id'] }}).data('answer');
                if(answer[index] == question_answer[index]){
                $('[name="true-and-false-questions[' + {{ $question['id'] }} + ']['+ index +']"]').parent().append('Đúng');
                $('[name="true-and-false-questions[' + {{ $question['id'] }} + ']['+ index +']"]').addClass('success-x2t')
            }else{
                $('[name="true-and-false-questions[' + {{ $question['id'] }} + ']['+ index +']"]').parent().append('Sai');
                    $('[name="true-and-false-questions[' + {{ $question['id'] }} + ']['+ index +']"]').addClass('error-x2t')
            }
            if(value == 'true'){
                $('[name="true-and-false-questions[' + {{ $question['id'] }} + ']['+ index +']"]')
                    .prop('checked', true);
            }
            console.log(value);
        });
    });
</script>
