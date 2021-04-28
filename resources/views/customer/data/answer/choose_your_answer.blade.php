<style>
    .error-x2t{
        color: red;
    }
    .success-x2t{
        color: green;
    }
</style>
<input type="hidden" name="question[choose-your-answer][]" value="{{ $question['id'] }}">
<p class="text-center">Trả lời câu hỏi</p>
<hr>
<div class="row">
    <div class="col-md-12">
        {!!  $question['content']  !!}
    </div>
</div>
<br>
<h3 class="title">Đáp án</h3>
<hr>
<div class="row">
    @foreach(json_decode($question['answer']) as $index => $value)
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Câu {{ $index }}</label>
            <input type="text" class="form-control question-x2t-choose-you-answer-{{ $question['id'] }}" value="{{ $value }}" placeholder="Đáp án câu {{ $index }}" name="choose-your-answer[{{ $question['id'] }}][{{$index}}]">
        </div>
    </div>
    @endforeach
</div>
<div id="choose-your-answer-{{ $question['id'] }}" data-answer="{{ $question['answer'] }}"></div>
<div id="answer-choose-your-answer-{{ $question['id'] }}" data-answer="{{ $answer }}"></div>

<script type="text/javascript">
    $( document ).ready(function() {
        $(".question-x2t-choose-you-answer-"+{{ $question['id'] }}).each(function (index) {
            console.log(index);
            var question_answer = $('#choose-your-answer-'+{{ $question['id'] }}).data('answer')[String.fromCharCode(65+index)];
            var answer = $('#answer-choose-your-answer-'+{{ $question['id'] }}).data('answer')[String.fromCharCode(65+index)];

            if(question_answer.toLowerCase().replaceAll(' ','') == answer.toLowerCase().replaceAll(' ','')){
                $(this).addClass('success-x2t');
            }else{
                $(this).addClass('error-x2t');
            }
        });
    });
</script>
