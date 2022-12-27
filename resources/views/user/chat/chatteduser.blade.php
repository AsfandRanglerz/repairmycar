<div>
    @foreach ($vendors as $data)
        @if (isset($data->vendor_id))
            <a href="#" class="favorite chatted d-flex align-items-center" value="vendor"
                id="{{ $data->vendor->id }}">
                <?php
                $unread = \App\Models\Chat::where([['customer_receiver_id', auth()->user()->id], ['vendor_sender_id', $data->vendor_id], ['seen', 0]])->count('seen');
                $vendor = \App\Models\Vendor::where('id', $data->vendor->id)->first();
                $gettime = strtotime($vendor->online_status) + 8;
                $now = strtotime(Carbon\Carbon::now());
                ?>
                <div class="inbox_contact justify-content-between">
                    <div class="position-relative contact_img">
                        <p id="userNotify">{{ $unread }}</p>
                        <img src="{{ asset($data->vendor->image) }}">
                        @if ($now < $gettime)
                            <h1 style="color: rgb(17, 243, 17); font-size: 100px;position: absolute;right: -3px;top: 0"
                                class="online-offline-dot">.</h1>
                        @else
                            <h1 style="color:white; font-size: 100px;position: absolute;right: -3px;top: 0"
                                class="online-offline-dot">.</h1>
                        @endif
                    </div>
                    <div class="name_of_contact">
                        <p class="mb-0">{{ $data->vendor->name }}</p>
                    </div>
                    <div class="chat_toggle_button">
                        <a href="#" id="del_toggle"><span class="bi bi-three-dots-vertical text-white"></span></a>
                        <div class="submenue shadow d-none" id="delet_user_toggle">
                            <ul>
                                <li><a href="#" class="chatted_delete d-block" id="{{ $data->vendor->id }}"
                                        value="vendor">
                                        <span class="fa fa-trash text-danger" aria-hidden="true"
                                            style="margin-right: 8px"></span>
                                        {{ __('msg.delete') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </a>
        @else
            @if ($data->customer_id == Auth::guard('web')->id())
                <a href="#" class="favoriteUser chatted d-flex align-items-center" value="customer"
                    id="{{ $data->customerchat->id }}">
                    <?php
                    $unread = \App\Models\Chat::where([['customer_receiver_id', auth()->user()->id], ['customer_sender_id', $data->customer_chat], ['seen', 0]])->count('seen');
                    $vendor = \App\Models\User::where('id', $data->customerchat->id)->first();
                    $gettime = strtotime($vendor->online_status) + 8;
                    $now = strtotime(Carbon\Carbon::now());
                    ?>
                    <div class="inbox_contact justify-content-between">
                        <div class="position-relative contact_img">
                            <p id="userNotify">{{ $unread }}</p>
                            <img src="{{ asset($data->customerchat->image) }}">
                            @if ($now < $gettime)
                                <h1 style="color: rgb(17, 243, 17); font-size: 100px;position: absolute;right: -3px;top: 0"
                                    class="online-offline-dot">.</h1>
                            @else
                                <h1 style="color:white; font-size: 100px;position: absolute;right: -3px;top: 0"
                                    class="online-offline-dot">.</h1>
                            @endif
                        </div>
                        <div class="name_of_contact">
                            <p class="mb-0">{{ $data->customerchat->name }}</p>
                        </div>
                        <div class="chat_toggle_button">
                            <a href="#" id="del_toggle"><span
                                    class="bi bi-three-dots-vertical text-white"></span></a>
                            <div class="submenue shadow d-none" id="delet_user_toggle">
                                <ul>
                                    <li><a href="#" class="chatted_delete d-block" value="customer"
                                            id="{{ $data->customerchat->id }}">
                                            <span class="fa fa-trash text-danger" aria-hidden="true"
                                                style="margin-right: 8px"></span>
                                            {{ __('msg.delete') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <a href="#" class=" favoriteUser chatted d-flex align-items-center" value="customer"
                    id="{{ $data->customer->id }}">
                    <?php
                    $unread = \App\Models\Chat::where([['customer_receiver_id', auth()->user()->id], ['customer_sender_id', $data->customer_id], ['seen', 0]])->count('seen');
                    $vendor = \App\Models\User::where('id', $data->customer->id)->first();
                    $gettime = strtotime($vendor->online_status) + 8;
                    $now = strtotime(Carbon\Carbon::now());
                    ?>
                    <div class="inbox_contact justify-content-between">
                        <div class="position-relative contact_img">
                            <p id="userNotify">{{ $unread }}</p>
                            <img src="{{ asset($data->customer->image) }}">
                            @if ($now < $gettime)
                                <h1 style="color: rgb(17, 243, 17); font-size: 100px;position: absolute;right: -3px;top: 0"
                                    class="online-offline-dot">.</h1>
                            @else
                                <h1 style="color:white; font-size: 100px;position: absolute;right: -3px;top: 0"
                                    class="online-offline-dot">.</h1>
                            @endif
                        </div>
                        <div class="name_of_contact">
                            <p class="mb-0">{{ $data->customer->name }}</p>
                        </div>
                        <div class="chat_toggle_button">
                            <a href="#" id="del_toggle"><span
                                    class="bi bi-three-dots-vertical text-white"></span></a>
                            <div class="submenue shadow d-none" id="delet_user_toggle">
                                <ul>
                                    <li><a href="#" class="chatted_delete d-block" value="customer"
                                            id="{{ $data->customer->id }}">
                                            <span class="fa fa-trash text-danger" aria-hidden="true"
                                                style="margin-right: 8px"></span>
                                            {{ __('msg.delete') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endif

    @endforeach
</div>
