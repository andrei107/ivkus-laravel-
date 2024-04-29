@extends('index')

@section('content')
@php $name = 'name_' . $lang;
     $short = 'short_' . $lang;
     $full_description = 'full_description_' . $lang;
@endphp
<div id="wrapper">
    <div class="advice-page">
        <div class="advice-page-wrapper">
            <div class="advice-item">
                <div class="advice-item-top">
                    <div class="advice-item-image" style="background-image: url({{asset('/storage/images/' . $adviceItem->img)}})">
                    </div>
                    <div class="advice-item-short">
                        <h2> {{$adviceItem->$name}} </h2>
                        <p> {{$adviceItem->$short}} </p>
                    </div>
                </div>
                <div class="advice-item-bottom">
                    <p> {{$adviceItem->$full_description}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
