@extends('index')

@section('content')
@php $name = 'name_' . $lang;
     $short = 'short_' . $lang;
@endphp
<div id="wrapper">
    <div class="all-advice">
        @foreach ($allAdvice as $key => $value )
        <a href="{{route('advice.item', ['id' => $value->id])}}">
                <div class="advice-item" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                    <h2 class="advice-item-name"> {{$value->name$}}</h2>
                    <div>
                        <div class="advice-item-image">
                        </div>
                        <div class="advice-item-short-descr">
                            <p> {{$value->$short}} </p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
