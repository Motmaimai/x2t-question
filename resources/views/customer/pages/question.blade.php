@extends('customer.main')
@push('link')
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/colors/switch.css">
@endpush
@section('main')
<div class="clearfix"></div>
<div class="wrapper wizard d-flex clearfix multisteps-form position-relative">
    <div class="steps order-2 position-relative w-25">
        <div class="multisteps-form__progress">
            @foreach($unit['data']['questions'] as $value)
                <span class="multisteps-form__progress-btn {{ (($loop->index+1==1)==1?'js-active':'') }}" title="Câu hỏi {{ $loop->index+1 }}"><i class="far fa-user"></i><span>Câu hỏi {{ $loop->index+1 }}</span></span>
            @endforeach
        </div>
    </div>

    <form class="multisteps-form__form w-75 order-1" action="{{ route('customer.answer',['id'=>$id]) }}" method="POST" id="wizard">
        @csrf
        <div class="form-area position-relative">
        @foreach($unit['data']['questions'] as $value)
            <!-- div 1 -->
                <div class="multisteps-form__panel {{ (($loop->index+1==1)==1?'js-active':'') }}" data-animation="slideHorz">
                    <div class="wizard-forms">
                        <div class="inner pb-100 clearfix">
                            <div class="wizard-title text-center">
                                <h3>{{ $value->title }} </h3>
                            </div>
                            <div class="wizard-title">
                                @include('customer.data.'.$value->category->view,['question'=>$value])
                            </div>
                            <div class="wizard-v3-progress">
                                <span>{{ $loop->index+1 }} to {{ count($unit['data']['questions']) }} step</span>
                                <h3>{{ number_format((($loop->index+1)/count($unit['data']['questions']))*100) }}% to complete</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ (($loop->index+1)/count($unit['data']['questions']))*100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- /.inner -->
                        <div class="actions">
                            <ul>
                                @if($loop->index+1>1)
                                    <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
                                @endif
                                @if($loop->index+1== count($unit['data']['questions']))
                                    <li><button title="NEXT">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                                @else
                                    <li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>
@endsection
@push('script')
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/switch.js"></script>
@endpush
