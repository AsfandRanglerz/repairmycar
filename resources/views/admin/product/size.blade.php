<select class="form-control select2" multiple="" name="size[]">
    @if (isset($product))
        @php
            $data_size = explode("|", $product->size);
        @endphp
        @foreach($size as $item)
            <option value="{{ $item->id }}" @if(in_array($item->id, $data_size)) selected @endif>{{ $item->size }}</option>
        @endforeach
    @else
        @foreach ($size as $item)
            <option value="{{ $item->id }}">{{ $item->size }}</option>
        @endforeach
    @endif
</select>

