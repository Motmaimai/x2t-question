<div class="row">
    <div class="col-md-12">
        <h3>Đề bài : {{ $question['title'] }}</h3>
        {!! $question['content'] !!}
    </div>
</div>
<div id="answer-choose_your_answer" data-answer="{{ $question['answer'] }}" class="row">

</div>
<script>
    $(document).ready(function() {
        var answer = $('#answer-choose_your_answer').data('answer');
        var html = '';
        $.each(answer , function( index, value ) {
            html += '<div class="form-group col-md-6">\n' +
                        '<label for="">Câu '+index+'</label>\n' +
                        '<input type="text" class="form-control" >\n' +
                    '</div>'
        });
        $('#answer-choose_your_answer').html(html);
    });
</script>
