<style>
    input[class*="question-x2t"] {
        border: none;
        border-bottom: 1px #0c0c0d dotted !important;
        text-align: center;
        outline: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3>Tiêu đề : {{ $question['data']['title'] }}</h3>
        {!! $question['data']['content'] !!}
    </div>
    <div id="answer" data-answer="{{ $question['data']['answer'] }}"></div>
</div>
<script>
    $( document ).ready(function() {
        $(".question-x2t-"+{{ $question['data']['id'] }}).each(function (index) {
            $(this).val($('#answer').data('answer')[index]);
        });
    });
</script>
