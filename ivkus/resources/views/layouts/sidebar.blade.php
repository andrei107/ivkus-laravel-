@php $name='name_' . $lang @endphp
<div class="current-name" >
    <p style="font-size: 27px; font-weight:bold">{{trans('staticText.receipts')}}</p>
</div>
<div class="menu-items-wrapper">
    <ul>
        @foreach ($menuItems as $key => $value )
            <li class="menu-item" data-id="{{$value->id}}" data-menu_id="{{$value->menu_id}}">
                <a href="{{route('receiptByMenu', ['menu_id' => $value->menu_id])}}"> {{$value->$name}} </a>
            </li>
        @endforeach
    </ul>
</div>
