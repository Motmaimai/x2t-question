<div class="row">
    <div class="col-md-12">
        <h3>Tiêu đề : {{ $question['data']['title'] }}</h3>
        {!! $question['data']['content'] !!}
    </div>
</div>
<div id="answer" data-answer="{{ $question['data']['answer'] }}" class="row">
    @foreach(json_decode($question['data']['question_child']) as $index => $value)
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
        var answer = $('#answer').data('answer');
        $.each(answer , function( index, value ) {
            $('#answer_'+index+'_'+value).attr('checked', true);
            console.log('answer_'+index+'_'+value);
        });
    });
</script>
