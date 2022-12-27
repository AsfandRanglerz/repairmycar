<div class="main_message">
    @if (count($message) > 0)
        @foreach ($message as $data)
            <?php
            $file = explode('.', $data->attachment);
            ?>
            @if ($data->type == 'vendor')
                <div class="inbox_contact align-items-end top_main" id="{{$data->id}}delete">
                    <div class="contact_img">
                        <img src="{{ asset($data->vendor->image) }}">
                    </div>
                    <div class="message_txt_wraper">
                        <p class="mb-2">{{ $data->created_at->format('h:s A') }}</p>
                        @if ($data->msgtype == 'text')
                            <p class="mb-0 message_txt" id="receiver_side">
                                <span class="fa fa-trash text-danger position-absolute del-content delete"
                                    aria-hidden="true" style="right: 3px;top: 3px;font-size: 11px;cursor: pointer"
                                    id="{{ $data->id }}"></span>
                                {{ $data->body }}
                            </p>
                        @else
                            <div class="message_txt">
                                <span class="fa fa-trash text-danger position-absolute del-content delete"
                                    aria-hidden="true" style="right: 3px;top: 3px;font-size: 11px;cursor: pointer"
                                    id="{{ $data->id }}"></span>
                                <div
                                    class="position-relative d-flex justify-content-center align-items-center img-download-block">
                                    @if ($data->customer_file_status == 0)
                                        <a class="position-absolute filedownload" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" id="file{{ $data->id }}"><i
                                                class="fa fa-download" aria-hidden="true"></i></a>
                                    @endif
                                    @if ($file[1] == 'docx')
                                        <img src="{{ asset('public/assets/images/wordicon.png') }}" width="70px">
                                    @elseif ($file[1] == 'pdf')
                                        <img src="{{ asset('public/assets/images/pdficon.png') }}" width="70px">
                                    @elseif ($file[1] == 'xlsx')
                                        <img src="{{ asset('public/assets/images/excelicon.png') }}" width="70px">
                                    @elseif ($file[1] == 'pptx')
                                        <img src="{{ asset('public/assets/images/ppicon.png') }}" width="70px">
                                    @else
                                        <img src="{{ asset($data->attachment) }}" width="100px">
                                    @endif
                                </div>
                                @if (isset($data->filetext))
                                    <p class="mb-0">{{ $data->filetext ?? '' }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="inbox_contact align-items-end top_main" id="{{$data->id}}delete">
                    <div class="contact_img">
                        <img src="{{ asset($data->customer->image) }}">
                    </div>
                    <div class="message_txt_wraper">
                        <p class="mb-2">{{ $data->created_at->format('h:s A') }}</p>
                        @if ($data->msgtype == 'text')
                            <p class="mb-0 message_txt" id="receiver_side">
                                <span class="fa fa-trash text-danger position-absolute del-content delete"
                                    aria-hidden="true" style="right: 3px;top: 3px;font-size: 11px;cursor: pointer"
                                    id="{{ $data->id }}"></span>
                                {{ $data->body }}
                            </p>
                        @else
                            <div class="message_txt">
                                <span class="fa fa-trash text-danger position-absolute del-content delete"
                                    aria-hidden="true" style="right: 3px;top: 3px;font-size: 11px;cursor: pointer"
                                    id="{{ $data->id }}"></span>
                                <div
                                    class="position-relative d-flex justify-content-center align-items-center img-download-block">
                                    @if ($data->customer_file_status == 0)
                                        <a class="position-absolute filedownload" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" id="file{{ $data->id }}"><i
                                                class="fa fa-download" aria-hidden="true"></i></a>
                                    @endif
                                    @if ($file[1] == 'docx')
                                        <img src="{{ asset('public/assets/images/wordicon.png') }}" width="70px">
                                    @elseif ($file[1] == 'pdf')
                                        <img src="{{ asset('public/assets/images/pdficon.png') }}" width="70px">
                                    @elseif ($file[1] == 'xlsx')
                                        <img src="{{ asset('public/assets/images/excelicon.png') }}" width="70px">
                                    @elseif ($file[1] == 'pptx')
                                        <img src="{{ asset('public/assets/images/ppicon.png') }}" width="70px">
                                    @else
                                        <img src="{{ asset($data->attachment) }}" width="100px">
                                    @endif
                                </div>
                                @if (isset($data->filetext))
                                    <p class="mb-0">{{ $data->filetext ?? '' }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
