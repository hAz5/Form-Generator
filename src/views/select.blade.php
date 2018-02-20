@if(isset($before))
    {!! $before !!}
@endif

<select @if($class) class="{!! $class !!}" @endif
        @if($id) id="{!! $id !!}" @endif
        @if($options) {!! $options !!} @endif
        @if($name) name="{!! $name !!}" @endif>

        @if($default)<option value="{!! $default['value'] !!}">{!! $default['label'] !!}</option> @endif

        @if($haveGroup)
                @foreach($groups as $group)
                        <optgroup label="{!! $group['label'] !!}">{!! $group['label'] !!}
                        @foreach($group['items'] as $key=>$item)
                                <option value="{!! $key !!}">{!! $item !!}</option>
                        @endforeach
                        </optgroup>
                @endforeach
        @else
                @foreach($items as $key=>$item)
                        <option value="{!! $key !!}">{!! $item !!}</option>
                @endforeach
        @endif

</select>
@if(isset($after))
    {!! $after !!}
@endif
