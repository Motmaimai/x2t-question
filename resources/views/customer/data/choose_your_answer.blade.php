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
            <input type="text" class="form-control" placeholder="Đáp án câu {{ $index }}" name="choose-your-answer[{{ $question['id'] }}][{{$index}}]">
        </div>
    </div>
    @endforeach
</div>

