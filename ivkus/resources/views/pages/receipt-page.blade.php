@extends('index')

@section('content')
@php $name = 'name_' . $lang;
     $short = 'short_' . $lang;
     $ingridients = 'ingridients_' . $lang;
     $receipt = 'receipt_' . $lang;
@endphp
<div id="wrapper">
    <div class="sidebar">
        @include('layouts.sidebar')
    </div>
    <div class="all-receipts">
        <div class="border-receipt">
            <div class="general-receipt-block">
                <div class="info-part">
                    <div class="name-receipt">
                        <p> {{$receiptItem->$name}} </p>
                    </div>
                    <div class="add-info-receipt">
                        <div class="add-top-info">
                            <div> <i class="fa fa-bars" aria-hidden="true"></i> {{trans('staticText.category')}}:</div>
                            <div> <i class="fa fa-clock-o" aria-hidden="true"></i> {{trans('staticText.time')}}:</div>
                            <div><i class="fa fa-users" aria-hidden="true"></i> {{trans('staticText.persons')}}:</div>
                            <div><i class="fa fa-cutlery" aria-hidden="true"></i> {{trans('staticText.calories')}}:</div>
                        </div>
                        <div class="add-bottom-info">
                           <div>{{$menuItem->name_ru}}</div>
                            <div>{{$receiptItem->time}}</div>
                            <div>{{$receiptItem->persons}}</div>
                            <div>{{$receiptItem->calories}}</div>
                        </div>
                    </div>
                </div>
                <div class="img-part" style="background-image: url({{asset('/storage/images/' . $receiptItem->img)}})">
                </div>
            </div>
            <div class="full-descr-receipt">
                <div class="ingridients-receipt-block">
                    <h3>{{trans('staticText.ingridients')}}</h3>
                    {!!$receiptItem->$ingridients!!}
                </div>
                <div class="descr-receipt-block">
                    <h3>{{trans('staticText.receipt')}}</h3>
                    {!!$receiptItem->$receipt!!}
                </div>
            </div>
        </div>
        <div class="related-receopts" style="background: #ccc">
            <div class="all-receipts" style="width: 100%">
                <h2 class="current-name" style="font-size: 27px; font-weight:bold">{{trans('staticText.interestion')}}</h2>
                <div class="container-receipt">
                    @foreach ($relatedReceipts as $key => $value )
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
    </div>
</div>
@endsection
