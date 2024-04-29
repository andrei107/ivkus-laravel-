<div class="filterBlocks">
    @foreach ($dataTypes as $key => $type )
        <div class="filter-item">
            <div class="form-group">
            <p>{{$type->name_ru}}</p>
            <select name="{{$type->type_code}}" class="form-select filterSelect">
                <option value="0"> Все</option>
                @foreach ($dataValues as $key => $value )
                    @if ($type->type_code == $value->type_code)
                    <option value="{{$value->type_code}}" data-operation="{{$value->operation}}" data-label="{{$value->value}}">
                            {{$value->value_ru}}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
        </div>
    @endforeach
</div>
