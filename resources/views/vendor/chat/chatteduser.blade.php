<div>
    @foreach($customer as $data)
    <a href="#" class="favorite chatted d-flex align-items-center" id="{{$data->customer->id}}">
        <?php
            $unread = \App\Models\Chat::where([['vendor_receiver_id',auth()->user()->id],['customer_sender_id',$data->customer_id],['seen',0]])->count('seen');
            $user = \App\Models\User::where('id',$data->customer->id)->first();
            $gettime = strtotime($user->online_status)+8;
            $now = strtotime(Carbon\Carbon::now());
       ?>
        <div class="inbox_contact justify-content-between">
            <div class="position-relative contact_img">
                <p id="userNotify">{{$unread}}</p>
                <img src="{{ asset($data->customer->image)}}">
                @if($now < $gettime)
                    <h1 style="color: rgb(17, 243, 17); font-size: 100px;position: absolute;right: -3px;top: 0" class="online-offline-dot">.</h1>
                @else
                    <h1 style="color:white; font-size: 100px;position: absolute;right: -3px;top: 0" class="online-offline-dot">.</h1>
                @endif
            </div>
            <div class="name_of_contact">
                <p class="mb-0">{{$data->customer->name}}</p>
            </div>
                <div class="chat_toggle_button">
                    <a href="#" id="chat_toggle"><span class="bi bi-three-dots-vertical text-white"></span></a>
                    <div class="submenue shadow d-none" id="delet_message_toggle">
                        <ul>
                            <li><a href="#" class="chatted_delete d-block" id="{{$data->customer->id}}">
                                    <span class="fa fa-trash text-danger" aria-hidden="true"
                                        style="margin-right: 8px"></span>
                                    {{__('msg.delete')}}</a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </a>
    @endforeach
</div>
