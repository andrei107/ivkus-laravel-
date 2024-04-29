@php $name='name_' . $lang @endphp
<div id="base-block">
	<h2 class="heading"> {{trans('staticText.blockBest')}} </h2>
	<div class="best-receipt-block">
		<div class="offer__slider-prev">
			<i class="fa fa-2x fa-arrow-circle-left" aria-hidden="true"></i>
		</div>
		<div class="slider-block">
            @foreach ($bestReceipts as $key => $value )
                <div class="best-receipt-item" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                    <a href="{{route('receipt.item', ['id' => $value->id])}}">
                        <div class="dark">
                            <div class="bestItemName">
                                <p> {{$value->$name}}
                                <br> <i class="fa fa-clock-o"> {{$value->time}} </i>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
		</div>
		<div class="offer__slider-next">
			<i class="fa fa-2x fa-arrow-circle-right" aria-hidden="true"></i>
		</div>
	</div>
</div>
