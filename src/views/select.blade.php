@if(isset($before))
    {!! $before !!}
@endif

<select @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
        @if($options) {!! $options !!} @endif
        @if($name) name="{!! $name !!}" @endif >

    {!! $items !!}
</select>
@if(isset($after))
    {!! $after !!}
@endif
