@php $name = 'name_' . $lang;
     $short = 'short_' . $lang;
@endphp
<div id="articles-on-main">
	<h2 class="heading">{{trans('staticText.blockAdvice')}}</h2>
	<div class="advice-block">
		<div class="advice-container">
			<div class="advice-content">
                @foreach ($advice as $key => $value )
                <a href="{{route('advice.item', ['id' => $value->id])}}">
                    <div class="tabcontent" style="background-image: url({{asset('/storage/images/' . $value->img)}})">
                        <div class="tabcontent-descr" >
                            <p> {{$value->$short}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
		 	</div>
		 	<div class="advice-header">
				<div>
                    @foreach ($advice as $key => $value )
                        <div class="advice-header-item"> {{$value->$name}} </div>
                     @endforeach
             	</div>
		 	</div>
		</div>
	</div>
</div>
