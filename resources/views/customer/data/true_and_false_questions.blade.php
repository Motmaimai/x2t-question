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
            <input type="checkbox" data-reverse value="true" data-id="true-and-false-questions-{{$question['id']}}-{{$index}}">
            <input type="hidden" value="false" name="true-and-false-questions[{{$question['id']}}][{{$index}}]" id="true-and-false-questions-{{$question['id']}}-{{$index}}">
        </div>
    </div>
    <hr>
@endforeach
<script>
    $(function() {
        $('input[type="checkbox"]').checkboxpicker();
        $('input[type="checkbox"]').on( 'change', function() {
            var id = $(this).data('id');
            $('#'+id).val($(this).is(":checked"));
        });
    });
</script>
