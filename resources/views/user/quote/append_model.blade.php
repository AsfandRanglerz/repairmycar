<select class="form-select form-control company-name-field" name="model" aria-label="car model" required>
    <option value="" selected disabled>
        {{ __('msg.Model') }}
        ({{ __('msg.Required') }})</option>
    @foreach ($model as $data)
        <option value="{{ $data->car_model }}" @if (old('company_id') == $data->car_model) selected @endif>
            {{ $data->car_model }}</option>
    @endforeach
</select>
@error('model')
    <div class="text-danger p-2">{{ $message }}</div>
@enderror
