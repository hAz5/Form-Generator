@if(isset($before))
    {!! $before !!}
@endif

<input @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
        @if($options) {!! $options !!} @endif
        @if($name) name="{!! $name !!}" @endif
        @if($type) type="{!! $type !!}" @endif
        @if($value) value="{!! $value !!}" @endif>

@if(isset($after))
    {!! $after !!}
@endif
