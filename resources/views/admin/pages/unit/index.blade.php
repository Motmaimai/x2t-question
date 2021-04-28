@extends('admin.main')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Units X2T english</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Units X2T english</li>
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
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Tài nguyên câu hỏi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" data-toggle="modal" data-target="#modal-file-manager" class="input-group-text">Thêm ảnh</button>
                                                </div>
                                                <input type="text" name="image" id="input-modal-file-manager" class="form-control" placeholder="Link hình ảnh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Nội dung câu hỏi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Unit</label>
                                            <input type="text" class="form-control" placeholder="Tên units">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <textarea name="description"  cols="30" rows="10" class="form-control" placeholder="Nội dung tóm tắt"></textarea>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status">
                                            <label class="form-check-label" for="status">Trạng thái</label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary float-right">Thêm câu hỏi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách Units</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="data-table" data-url="{{ route('admin.unit.load-data') }}">
                                        <thead>
                                        <tr>
                                            <th scope="col">Tên lớp học</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hoạt động</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th scope="col">Tên lớp học</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hoạt động</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
    <!-- /.content-wrapper -->
    @include('admin.package.modal-file-manager',['id'=>'modal-file-manager','size'=>'xl','title'=>'File manager'])
@endsection

@push('script')
    <script >
        $(function() {

            function loaddata() {
                if ($.fn.dataTable.isDataTable('#data-table')) {
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
                        {data: 'name', name: 'name'},
                        {data: 'image', name: 'image'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action'},
                    ]
                });
            }

            loaddata();
        });
    </script>
@endpush
