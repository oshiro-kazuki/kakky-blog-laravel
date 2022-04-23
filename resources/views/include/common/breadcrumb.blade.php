<aside class="breadcrumb">
    @if(count($breadcrumb) > 0)
        @foreach($breadcrumb as $text => $link)
            @if($loop->last)
                <p>{{ $text }}</p>
            @else
                <a href="{{ $link }}">{{ $text }}</a> /
            @endif
        @endforeach
    @endif
</aside>