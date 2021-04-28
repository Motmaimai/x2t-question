<style>
    input[class*="question-x2t"] {
        border: none;
        border-bottom: 1px #0c0c0d dotted !important;
        background-color: #f5f7f8;
        text-align: center;
    }
</style>
<input type="hidden" name="question[filling-in-the-blank][]" value="{{ $question['id'] }}">
<p class="text-center">Điền đáp án vào chỗ trống </p>
<hr>
<div class="row">
    <div class="col-md-12 filling-in-the-blank">
        {!!  $question['content']  !!}
    </div>
</div>
