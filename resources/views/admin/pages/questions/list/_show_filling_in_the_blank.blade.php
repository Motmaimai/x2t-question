<style>
    .filling_in_the_blank input{
        border: none !important;
        border-bottom: 1px #0c0c0d dotted !important;
        outline: none;
    }
</style>
<div class="row filling_in_the_blank" >
    <div class="col-md-12">
        <h3>Đề bài : {{ $question['title'] }}</h3>
        {!! $question['content'] !!}
    </div>
    <div id="answer-filling_in_the_blank" data-answer="{{ $question['answer'] }}"></div>
</div>
