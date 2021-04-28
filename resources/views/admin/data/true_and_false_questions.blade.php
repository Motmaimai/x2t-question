<div class="form-group col-md-12">
    <label for="">Nội dung câu hỏi <span class="danger">(True False)</span></label>
    <textarea name="contents" id="editor-ckeditor" rows="10" cols="80"></textarea>
</div>
<div class="form-group col-md-12" id="answer-x2t">
    <label for="" class="d-flex justify-content-between"><span>Câu hỏi 1</span><a href="javascript:void(0)" class="x2t-event-click">Thêm đáp án</a></label>
    <input type="text" name="question_child[1]" class="form-control answer-x2t" placeholder="Câu trả lời">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="answer[1]"  value="true" checked>
        <label class="form-check-label" >
            True
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio"  name="answer[1]"  value="false">
        <label class="form-check-label" >
            False
        </label>
    </div>
</div>
