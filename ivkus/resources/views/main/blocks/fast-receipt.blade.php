@php $name='name_' . $lang @endphp
<div id="base-block">
	<h2 class="heading"> {{trans('staticText.blockFast')}} </h2>
	<div class="fast-receipt-block">
		<div class="offer__slider-prev-fast">
			<i class="fa fa-2x fa-arrow-circle-left" aria-hidden="true"></i>
		</div>
		<div class="slider-block">
            @foreach ($fastReceipts as $key => $value )
                <div class="fast-receipt-item" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                    <a href="{{route('receipt.item', ['id' => $value->id])}}">
                        <div class="dark">
                            <div class="fastItemName">
                                <p> {{$value->$name}}
                                <br><i class="fa fa-clock-o"> {{$value->time}} </i>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
		</div>
	    <div class="offer__slider-next-fast">
			<i class="fa fa-2x fa-arrow-circle-right" aria-hidden="true"></i>
		</div>
	</div>
</div>
