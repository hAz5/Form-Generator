@if(isset($before))
    {!! $before !!}
@endif

<button @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
        @if($options) {!! $options !!} @endif
        @if($name) name="{!! $name !!}" @endif
        @if($type) type="{!! $type !!}" @endif
       >
        @if($value)  {!! $value !!} @endif
</button>

@if(isset($after))
    {!! $after !!}
@endif
