@extends('customer.main')
@section('main')
    <div class="container p-5 border mt-5 mb-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <b class="h3">Cộng hòa xã hội chủ nghĩa Việt Nam</b>
                <p>Độc lập - Tự do - Hạnh phúc</p>
                <hr>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <h4>Bài kiểm tra : {{ $unit['data']['name'] }}</h4>
                <h4>Họ và tên : {{ Auth::guard('customer')->user()->name }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Đáp án</h1>
                <div class="text-center">
                    <span>Hoàn thành đúng : <span id="success-x2t"></span>/ <span id="total-x2t"></span><span id="percent-x2t"></span></span>
                </div>
            </div>
            <div class="col-lg-12">
                @foreach($answer['data'] as $value)
                    <div class="col-md-12">
                        <hr>
                        <h5>Câu hỏi {{ $loop->index+1 }}</h5>
                        @include('customer.data.answer.'.$value['question']->category->view,['question'=>$value['question'],'answer'=>$value['answer']])
                    </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('customer.home') }}" class="float-right">Trở về trang chủ</a>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            var error = $(".error-x2t").length;
            var success = $(".success-x2t").length;
            $('#success-x2t').html(success);
            $('#total-x2t').html(success + error);
            $('#percent-x2t').html("("+(success/(success + error))*100+")");
        });

    </script>
@endpush
