$( document ).ready(function() {

    $('.select2').select2();
    $('#category').change(function () {
        var view = $('#category option:selected').data('view');
        var url = $(this).data('url');
        $.ajax({
            url:url,
            method:"get",
            data:{
                view:view
            },
            success:function(data){
                $('#data').html(data);
                switch (view) {
                    case 'filling_in_the_blank':
                        filling_in_the_blank();
                        console.log('filling_in_the_blank');
                        break;
                    case 'choose_your_answer':
                        choose_your_answer();
                        console.log('choose_your_answer');
                        break;
                    case  'true_and_false_questions':
                        true_and_false_questions();
                        console.log('true_and_false_questions');
                        break;
                }
                ckeditor();
            }
        });
    });

    // show question
    $(document).on("click",".btn-show",function() {
        var url = $(this).data('url');
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                $('#modal-modal-show').html(data);
            }
        });
    })
    // show edit question
    $(document).on("click",".btn-edit",function() {
        var url = $(this).data('url');
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                $('#modal-modal-edit').html(data);
                ckeditor();
            }
        });
    })
    function true_and_false_questions() {
        $(document).on("click",".x2t-event-click",function() {
            var n = $('.answer-x2t').length + 1;
            var html = '<hr/>'+
                `<div class="form-group col-md-12" id="answer-x2t">
                    <label for="" class="d-flex justify-content-between"><span>C??u h???i ${n}</span><a href="javascript:void(0)" class="x2t-event-click">Th??m ????p ??n</a></label>
                    <input type="text" name="question_child[${n}]" class="form-control answer-x2t" placeholder="C??u tr??? l???i">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer[${n}]"  value="true" checked>
                        <label class="form-check-label" >
                            True
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="answer[${n}]" value="false">
                        <label class="form-check-label" >
                            False
                        </label>
                    </div>
                </div>`;
            $('#answer-x2t').append(html)
        });
    }

    function choose_your_answer() {
        $(document).on("click",".x2t-event-click",function() {
            var n = $('.answer-x2t').length;
            var html = '<hr/>'+
                '<label for="" class="d-flex justify-content-between"><span>????p ??n '+String.fromCharCode(65+n)+'</span><a href="javascript:void(0)" class="x2t-event-click">Th??m ????p ??n</a></label>' +
                '<input type="text" name="answer['+String.fromCharCode(65+n)+']" class="form-control answer-x2t" placeholder="C??u tr??? l???i '+String.fromCharCode(65+n)+'">';
            $('#answer-x2t').append(html)
        });
    }

    function filling_in_the_blank() {
        $(document).on("click",".x2t-event-click",function() {
            var n = $('.answer-x2t').length + 1;
            var html = '<hr/>'+
                '<label for="" class="d-flex justify-content-between"><span>????p ??n '+n+'</span><a href="javascript:void(0)" class="x2t-event-click">Th??m ????p ??n</a></label>' +
                '<input type="text" name="answer[]" class="form-control answer-x2t" placeholder="C??u tr??? l???i '+n+'">';
            $('#answer-x2t').append(html)
        });
    }
    function ckeditor() {
        CKEDITOR.replace( 'editor-ckeditor' ,{
            filebrowserBrowseUrl : 'responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl : 'responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl : 'responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
        });
    }

    function loaddata() {
        if ( $.fn.dataTable.isDataTable( '#data-table' ) ) {
            $('#data-table').DataTable().destroy();
        }
        var url = $('#data-table').data('url');
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: url,
            columns: [
                { data: 'title', name: 'title' },
                { data: 'action', name: 'action' },
            ]
        });
    }
    loaddata();
});
