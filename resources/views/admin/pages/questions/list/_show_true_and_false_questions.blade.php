<div class="row">
    <div class="col-md-12">
        <h3>Đề bài : {{ $question['title'] }}</h3>
        {!! $question['content'] !!}
    </div>
</div>
<div id="answer-true_and_false_questions" data-answer="{{ $question['answer'] }}" class="row">
    @foreach(json_decode($question['question_child']) as $index => $value)
        <div class="col-md-12">
            <label for="" class="d-flex justify-content-between"><span>Câu hỏi {{ $loop->index+1 }}</span></label>
            <p>Nội dung : {{ $value }}</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[{{ $index }}]"  value="true" id="answer_{{ $index }}_true">
                <label class="form-check-label" >
                    True
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio"  name="answer[{{ $index }}]"  value="false" id="answer_{{ $index }}_false">
                <label class="form-check-label" >
                    False
                </label>
            </div>
            <hr>
        </div>
    @endforeach
</div>
<script>
    $( document ).ready(function() {
        var answer = $('#answer-true_and_false_questions').data('answer');
    });
</script>
