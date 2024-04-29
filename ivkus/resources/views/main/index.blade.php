@extends('index')

@section('content')
<div id="index">
    @include('main.blocks.best-receipt')
    @include('main.blocks.day-receipt')
    @include('main.blocks.fast-receipt')
    @include('main.blocks.advice-main')
</div>
@endsection
