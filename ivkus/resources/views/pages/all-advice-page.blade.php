@extends('index')

@section('content')
@php $name = 'name_' . $lang;
     $short = 'short_' . $lang;
@endphp
<div id="wrapper">
    <div class="all-advice-page">
        <div class="all-advice-wrapper">
            @foreach ($allAdvice as $key => $value )
                <div class="all-advice-item">
                    <a href="{{route('advice.item', ['id' => $value->id])}}">
                        <div class="all-advice-item-img" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                        </div>
                        <div class="all-advice-item-descr">
                            <h2 class="all-advice-name"> {{$value->$name}} </h2>
                            <p class="all-advice-text"> {{$value->$short}} </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
