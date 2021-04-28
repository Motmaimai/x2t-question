@extends('admin.main')
@push('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .question-x2t{
            outline: none !important;
            border: none ;
            border-bottom: 1px #0c0c0d solid !important;
            width:auto !important;
            text-align: center;
        }
    </style>
@endpush
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Câu hỏi X2T english</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Câu hỏi X2T english</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.questions.store') }}" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" placeholder="Tiêu đề">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Unit</label>
                                <select name="unit_id" id="" class="form-control select2">
                                    @foreach($unit['data'] as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Loại câu hỏi</label>
                                <select name="category_id" id="category" class="form-control select2" data-url="{{ route('admin.load-view') }}">
                                    <option value="">Chọn loại câu hỏi</option>
                                    @foreach($categories['data'] as $value)
                                        <option value="{{ $value['id'] }}" data-view="{{ $value['view'] }}">{{ $value['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Thứ tự</label>
                                <input type="number" name="order_by" class="form-control" placeholder="Tiêu đề">
                            </div>
                            <div id="data" class="w-100">

                            </div>
                            <br>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-secondary float-right">Thêm câu hỏi</button>
                            </div>
                        </div>
                        @csrf
                    </form>

                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h3>Danh sách lớp học</h3>
                            </div>
                            <div class="card-body">
                                <table class="table" id="data-table" data-url="{{ route('admin.questions.load-data') }}">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tên lớp học</th>
                                        <th scope="col">Hoạt động</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">Tên lớp học</th>
                                        <th scope="col">Hoạt động</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    @include('admin.package.modal',['id'=>'modal-show','size'=>'xl','title'=>'Nội dung câu hỏi'])
    @include('admin.package.modal',['id'=>'modal-edit','size'=>'xl','title'=>'Chỉnh sửa nội dung câu hỏi'])
    <!-- /.content-wrapper -->
    @include('admin.package.modal-file-manager',['id'=>'modal-file-manager','size'=>'xl','title'=>'File manager'])
@endsection
@push('script')
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="x2t-js/question.js"></script>
@endpush
