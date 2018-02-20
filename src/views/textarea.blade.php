@if(isset($before))
    {!! $before !!}
@endif

<textarea @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
        @if($options) {!! $options !!} @endif
        @if($name) name="{!! $name !!}" @endif >
        @if($value) {!! $value !!} @endif
</textarea>
@if(isset($after))
    {!! $after !!}
@endif
