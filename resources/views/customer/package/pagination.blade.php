<div class="pagination">
    @if(request()->page <= 1)
        <a href="javascript:void(0)" class="prev-button"><i class="icon-angle-left"></i></a>
    @else
        <a href="{{ url()->current()."?page=".(request()->page - 1) }}" class="prev-button"><i class="icon-angle-left"></i></a>
    @endif
    @for($i=1;$i<=$total;$i++)
        @if(request()->page==$i || (request()->page == null) && $i ==1)
            <span class="current">{{ $i }}</span>
        @else
            <a href="{{ url()->current()."?page=".$i }}">{{ $i }}</a>
        @endif
    @endfor
    @if(request()->page >= $total)
        <a href="javascript:void(0)" class="next-button"><i class="icon-angle-right"></i></a>
    @else
        @if(request()->page == null && $total >=2)
            <a href="{{ url()->current()."?page=2" }}" class="next-button"><i class="icon-angle-right"></i></a>
        @else
            <a href="{{ url()->current()."?page=".(request()->page + 1) }}" class="next-button"><i class="icon-angle-right"></i></a>
        @endif
    @endif
</div>
<!-- End pagination -->
