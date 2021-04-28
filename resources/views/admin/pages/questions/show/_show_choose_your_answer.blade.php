<div class="row">
    <div class="col-md-12">
        <h3>Tiêu đề : {{ $question['data']['title'] }}</h3>
        {!! $question['data']['content'] !!}
    </div>
</div>
<div id="answer" data-answer="{{ $question['data']['answer'] }}" class="row">

</div>
<script>
    $( document ).ready(function() {
        var answer = $('#answer').data('answer');
        var html = '';
        $.each(answer , function( index, value ) {
            html += '<div class="form-group col-md-6">\n' +
                        '<label for="">Câu '+index+'</label>\n' +
                        '<input type="text" class="form-control" value="'+value+'">\n' +
                    '</div>'
        });
        $('#answer').html(html);
    });
</script>
