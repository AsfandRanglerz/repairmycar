@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.Downloaded Images & Files') }}</h4>
                    </div>
                </div>
            </div>
            <div class="bg-white px-2 py-3 mx-3" style="border-radius: 10px">
                <div class="row mx-0">
                    <h5 class="mb-3 heading-color">{{ __('msg.Images') }}</h5>
                    @if ($attachment->count() > 0)
                        @foreach ($attachment as $data)
                            <?php
                            $file = explode('.', $data->file);
                            $file_name = explode('/', $data->file);
                            ?>
                            @if ($file[1] == 'jpg' || $file[1] == 'png' || $file[1] == 'svg')
                                <div class="mb-3 col-md-3 position-relative item" id="{{ $data->id }}">
                                    <span class="fa fa-trash text-danger position-absolute del-content delete"
                                        aria-hidden="true" style="left: 20px;top: 5px;font-size: 14px;cursor: pointer;background: #FFF;padding: 4px"
                                        id="{{ $data->id }}"></span>
                                    <p class="sender-name">{{ __('msg.Sended By:') }} {{ $data->sender_name }}</p>
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center w-100 carAd_img_wraper doc_img customer_dashboard">
                                        <p class="file-title">Title: {{ $data->file_name }}</p>
                                        <a class="position-absolute filedownload" download="{{ $file_name[2] }}"
                                            id="{{ $data->id }}" href="{{ asset($data->file) }}" title="image"><i
                                                class="fa fa-download" aria-hidden="true"></i></a>
                                        <img src="{{ asset($data->file) }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>{{ __('msg.There is no image') }}</p>
                    @endif
                </div>
                <div class="row mx-0">
                    <h5 class="mb-3 heading-color">{{ __('msg.Files') }}</h5>
                    @if ($attachment->count() > 0)
                        @foreach ($attachment as $data)
                            <?php
                            $file = explode('.', $data->file);
                            $file_name = explode('/', $data->file);
                            ?>
                            @if ($file[1] == 'pdf' || $file[1] == 'docx' || $file[1] == 'xlsx' || $file[1] == 'pptx')
                                <div class="mb-3 col-md-3 position-relative item" id="{{ $data->id }}">
                                    <span class="fa fa-trash text-danger position-absolute del-content delete"
                                        aria-hidden="true" style="left: 20px;top: 5px;font-size: 14px;cursor: pointer;background: #FFF;padding: 4px"
                                        id="{{ $data->id }}"></span>
                                    <p class="sender-name">{{ __('msg.Sended By:') }} {{ $data->sender_name }}</p>
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center w-100 carAd_img_wraper doc_img customer_dashboard">
                                        <p class="file-title">Title: {{ $data->file_name }}</p>
                                        <a class="position-absolute filedownload" download="{{ $file_name[2] }}"
                                            id="{{ $data->id }}" href="{{ asset($data->file) }}" title="image"><i
                                                class="fa fa-download" aria-hidden="true"></i></a>
                                        @if ($file[1] == 'docx')
                                            <img src="{{ asset('public/assets/images/wordicon.png') }}" class="file-img">
                                        @elseif ($file[1] == 'pdf')
                                            <img src="{{ asset('public/assets/images/pdficon.png') }}" class="file-img">
                                        @elseif ($file[1] == 'xlsx')
                                            <img src="{{ asset('public/assets/images/excelicon.png') }}" class="file-img">
                                        @elseif ($file[1] == 'pptx')
                                            <img src="{{ asset('public/assets/images/ppicon.png') }}" class="file-img">
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>{{ __('msg.There is no file') }}</p>
                    @endif

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).on('click', '.delete', function() {
            var file_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                url: "{{ route('vendor.archive.delete') }}",
                data: {
                    'file_id': file_id,
                },
                success: function(response) {
                    $("#" + file_id).addClass('d-none');

                }
            });
        });
    </script>
@endsection
