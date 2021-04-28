<form action="{{ route('admin.questions.store') }}" method="post">
    <div class="row">
        <div class="form-group col-md-12">
            <label for="">Tiêu đề</label>
            <input type="text" name="title" value="{{ $question['data']['title'] }}" class="form-control" placeholder="Tiêu đề">
        </div>
        <div class="form-group col-md-4">
            <label for="">Unit</label>
            <select name="unit_id" id="" class="form-control select2">
                @foreach($unit['data'] as $value)
                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Danh mục</label>
            <input type="text" class="form-control" disabled value="{{ $question['data']['category']->name }}">
        </div>
        <div class="form-group col-md-4">
            <label for="">Thứ tự</label>
            <input type="number" name="order_by" value="{{ $question['data']['order_by'] }}" class="form-control" placeholder="Tiêu đề">
        </div>
        <div class="form-group col-md-12">
            <label for="">Nội dung câu hỏi <span class="danger">(True False)</span></label>
            <textarea name="contents" id="editor-ckeditor" rows="10" cols="80">{{ $question['data']['content'] }}</textarea>
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
        <br>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-secondary float-right">Thêm câu hỏi</button>
        </div>
    </div>
    @csrf
</form>
