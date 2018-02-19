@if(isset($before))
    {!! $before !!}
@endif

<form @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
            action="{!! $action !!}"
                @if($baseMethod) method="{!! $baseMethod !!}" @endif
                    @if($options) {!! $options !!} @endif>
    @if($method)
        {!! method_field($method) !!}
    @endif

    @if($csrf)
        {!! csrf_field() !!}
    @endif

    @foreach($elements as $element)
        {!! $element !!}
    @endforeach
</form>

@if(isset($after))
    {!! $after !!}
@endif
