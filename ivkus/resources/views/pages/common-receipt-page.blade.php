@extends('index')

@section('content')
@php $name = 'name_' . $lang; @endphp
<div id="wrapper">
    <div class="sidebar">
        @include('layouts.sidebar')
    </div>
	<form id="filter-form" class="form" method="GET">
        <span>Filter Products</span>
         <input type="text" name="search-data" placeholder="" class="form-control search-data"/>
    </form>
    <input type="submit" value="filter" class="btn btn-sm btn-secondary btn-f btnfilter"/>
    <div class="all-receipts">
        <h2 class="current-name" style="font-size: 27px; font-weight:bold">{{trans('staticText.allReceipts')}}</h2>
       @include('layouts.partials.filters')
        <div class="container-receipt">
            @foreach ($allReceipts as $key => $value )
                <a href="{{route('receipt.item', ['id' => $value->id])}}" data-menu_id="{{$value->menu_id}}">
                    <div class="receipt-item" style="background-image: url({{asset('/storage/images/' . $value->img)}})"
                        data-menu="{{$value->for_menu}}" data-time="{{$value->time}}" data-persons="{{$value->persons}}"
                        data-calories="{{$value->calories}}"  >
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
	<ul style="display: flex; padding: 10px;">
        @for($page_number = 1; $page_number <= $count; $page_number++)
            <li style="display: flex; padding: 10px;" class="page-item @php echo isset($_GET['page-number']) && $_GET['page-number'] == $page_number ? 'active' : ''; @endphp">
             <a class="page-link" href="#" data-page-number="@php echo $page_number; @endphp">
                 {{$page_number }}
               </a>
             </li>
        @endfor
    </ul>
@endsection
