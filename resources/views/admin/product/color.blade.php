@if (isset($product))
    @php
        $get_color = $product->color;
        $data_color = explode("|", $get_color);
        //dd($colors)
    @endphp
    @foreach($color as $data)
        <div class="col-auto">
            <label class="colorinput">
                <input name="color[]" type="checkbox" value="{{$data->id}}" class="colorinput-input"
                       @if(in_array($data->id, $data_color)) checked @endif multiple/>
                <span class="colorinput-color" style="background-color: {{$data->color}}"></span>
            </label>
        </div>
    @endforeach
@else
    @foreach($color as $data)
        <div class="col-auto">
            <label class="colorinput">
                <input name="color[]" type="checkbox" value="{{$data->id}}" class="colorinput-input" multiple/>
                <span class="colorinput-color" style="background-color: {{$data->color}}"></span>
            </label>
        </div>
    @endforeach
@endif


