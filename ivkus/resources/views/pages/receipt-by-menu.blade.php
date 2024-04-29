@extends('index')

@section('content')
@php $name = 'name_' . $lang; @endphp
<div id="wrapper">
    <div class="sidebar">
        @include('layouts.sidebar')
    </div>
    <div class="all-receipts">
        <h2 class="current-name" style="font-size: 27px; font-weight:bold">{{$blockName->$name}}</h2>
        <div class="container-receipt">
            @foreach ($receiptsInCategory as $key => $value )
                <a href="{{route('receipt.item', ['id' => $value->id])}}" data-menu_id="{{$value->menu_id}}">
                    <div class="receipt-item" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                        <div class="dark">
                            <div class="item-name">
                                {{$value->$name}}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
