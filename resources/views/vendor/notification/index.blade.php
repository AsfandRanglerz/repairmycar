
    <ul class="notification_list shadow">
        @foreach($notification as $data)
        <li><a href="{{ $data->links }}" class="notification" title="{{$data->title}}" id="{{$data->id}}">{{$data->title}}</a> <a href="#" class="notification" id="{{$data->id}}"><i
                    class="bi bi-plus"></i></a>
        </li>
        @endforeach
    </ul>
