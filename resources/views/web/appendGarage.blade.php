<option selected disabled value="">Select Garage</option>
@forelse($data as $garageData)
    <option selected  value="{{$garageData->garage->id}}">{{$garageData->garage->garage_name}}</option>
@empty
@endforelse
