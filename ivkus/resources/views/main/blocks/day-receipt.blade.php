@php $name='name_' . $lang @endphp
<div id="base-block">
	<h2 class="heading"> {{trans('staticText.blockDay')}} </h2>
	@foreach ($dayReceipt as $key => $value )
		<div class="day-receipt-block" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
			<div class="dark-mask">
				<div class="day-receipt-name"> {{$value->$name}} </div>
			</div>
		</div>
	@endforeach
</div>
