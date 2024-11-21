@extends("front.patients.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">Main</h6>
            <ul>
                <li class="">
                    <a href="{{ route('patient.dashboard') }}"><i class="fa fa-columns"></i><span class="px-2">@lang("Dashboard")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.profile') }}"><i class="fa fa-user"></i><span class="px-2">@lang("My Profile")</span></a>
                </li>
                <li>
                    <a href="{{ route('patient.get_my_appointments_page') }}"><i class="fa fa-user-md"></i> <span class="px-2">@lang("My Appointments")</span></a>
                </li>
                <li class="{{ $type == "healthcare" ? 'active' : "" }}">
                    <a href="{{ route('patient.get_my_chat_page' , ["type" => "healthcare"] ) }}"><i class="fa fa-envelope"></i><span class="px-2">@lang("Healthcare Messages")</span></a>
                </li>
                <li class="{{ $type == "patient" ? 'active' : "" }}">
                    <a href="{{ route('patient.get_my_chat_page', ["type" => "patient"] ) }}"><i class="fa fa-comments"></i><span class="px-2">@lang("Timeline Messages")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.timeline') }}"><i class="fa fa-newspaper"></i><span class="px-2">@lang('Manage posts')</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.saved_announces') }}"><i class="fa fa-save"></i><span class="px-2">@lang('Saved Announces')</span></a>
                </li>
                <li>
                    <form action="{{ route('logout_patient') }}" method="post">@csrf
                        <button  type="submit" style="font-weight: 500;font-size: 16px;color: #67748e;position: relative;display: flex;align-items: center;padding: 8px 15px;background: unset;border: 0;">
                            <i class="fa fa-door-open"></i>
                            <span class="px-2">@lang("Sign out")</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
@endsection
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row chat-window">
                <!-- Chat User List -->
                <div class="col-lg-5 col-xl-4 chat-cont-left">
                    <div class="card mb-sm-3 mb-md-0 contacts_card flex-fill">
                        <div class="card-header chat-search">
                            <div class="input-group mb-3">
                                    <select name="query" id="remoteSearchPatientInput" class="search-chat  rounded-pill">
                                        <option value=""></option>
                                    </select>
                            </div>
                        </div>
                        <div class="card-body contacts_body chat-users-list chat-scroll">
                            @if($contacts->count())
                                @foreach($contacts as $contact)
                                    <a href="{{ route('patient.get_my_chat_page' , ['type' => $type , 'current' =>  $contact->id ]) }}"  data-url="{{ $contact->id }}" class="chat-load media d-flex read-chat">
                                        <div class="media-img-wrap flex-shrink-0">
                                            <div class="avatar avatar-online">
                                                <img src="{{ $contact->getFirstMediaUrl('avatar' , 'thumb') }}" alt="{{ $contact->name }}" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body flex-grow-1">
                                            <div>
                                                <div class="user-name">{{ $contact->name }}</div>
                                                <div class="user-last-chat">{{ $contact->email }} </div>
                                            </div>
                                            <div>
                                                <div class="last-chat-time">8:01 PM</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Chat User List -->

                <!-- Chat Content -->
                <div class="col-lg-7 col-xl-8 chat-cont-right">
                    @if($current)
                        <!-- Chat History -->
                        <div class="card mb-0">

                            <div class="card-header msg_head">
                                <div class="d-flex bd-highlight">
                                    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <div class="img_cont">
                                        <img class="rounded-circle user_img" src="{{ $current->getFirstMediaUrl('avatar' , 'thumb') }}" alt="">
                                    </div>
                                    <div class="user_info">
                                        <span><strong id="receiver_name">{{ $current->name }}</strong></span>
                                        <p class="mb-0">@lang("Messages")</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body msg_card_body chat-scroll">
                                <ul class="list-unstyled">
                                    @if($messages)
                                        @foreach($messages as $message)
                                            @if($message->sender_type == 'healthcare' and $message->receiver_id == $profile->id)
                                                <li class="media received d-flex">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ $current->getFirstMediaUrl('avatar' , 'thumb') }}" alt="{{ $current->name . ' Image' }}" class="avatar-img rounded-circle">
                                                    </div>
                                                    <div class="media-body flex-grow-1">
                                                        <div class="msg-box">
                                                            <div>
                                                                <p>{{ $message->content }}</p>
                                                                <ul class="chat-msg-info">
                                                                    <li>
                                                                        <div class="chat-time">
                                                                            <span>{{ $message->created_at->format('Y-m-d H:i') }}</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @if($message->getFirstMediaUrl('file'))
                                                            <div class="msg-box">
                                                                <div>
                                                                    <div class="chat-msg-attachments">
                                                                        <div class="chat-attachment">
                                                                            <img style="min-width: 60px;" src="{{ asset('patient/assets/img/icons/dash3.svg') }}" alt="Attachment">
                                                                            <a  target="_blank" href="{{ $message->getFirstMediaUrl('file') }}" class="chat-attach-download">
                                                                                <i class="fas fa-download"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <ul class="chat-msg-info">
                                                                        <li>
                                                                            <div class="chat-time">
                                                                                <span>{{ $message->getFirstMedia('file')->file_name }}</span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @elseif($message->sender_type == 'patient' and $message->receiver_id == $current->id)
                                                <li class="media sent d-flex">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ $profile->getFirstMediaUrl('avatar' , 'thumb') }}" alt="{{ $profile->name . ' Image' }}" class="avatar-img rounded-circle">
                                                    </div>
                                                    <div class="media-body flex-grow-1">
                                                        <div class="msg-box">
                                                            <div>
                                                                <p>{{ $message->content }}</p>
                                                                <ul class="chat-msg-info">
                                                                    <li>
                                                                        <div class="chat-time">
                                                                            <span>{{ $message->created_at->format('Y-m-d H:i') }}</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @if($message->getFirstMediaUrl('file'))
                                                            <div class="msg-box">
                                                                <div>
                                                                    <div class="chat-msg-attachments">
                                                                        <div class="chat-attachment">
                                                                            <img style="min-width: 60px;" src="{{ asset('patient/assets/img/icons/dash3.svg') }}" alt="Attachment">
                                                                            <a target="_blank" href="{{ $message->getFirstMediaUrl('file') }}" class="chat-attach-download">
                                                                                <i class="fas fa-download"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <ul class="chat-msg-info">
                                                                        <li>
                                                                            <div class="chat-time">
                                                                                <span>{{ $message->getFirstMedia('file')->file_name }}</span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>

                            </div>

                            <div class="card-footer">
                                <form action="{{ route('patient.send_message_to' , [$current->id , $type]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <label for="file" class="btn btn-outline-primary"><i class="fa fa-upload"></i></label>
                                        <input name="file" id="file" type="file" accept="image/*" class="form-control d-none">
                                        <input class="form-control type_msg mh-auto empty_check" name="content" placeholder="Type your message...">
                                        <button class="btn btn-primary btn_send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- Chat Content -->

            </div>

        </div>
    </div>

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <style>
        label
        {
            font-size:large !important;
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('patient/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('patient/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('build/assets/app.js') }}"></script>
    <script>
        window.Echo.channel('messages')
            .listen('MessageReceived', (event) => {
                console.log('New message received:', event.message);
                // Implement logic to update the UI with the new message
            });

        $('#remoteSearchPatientInput').select2({
            placeholder: 'Search for a person',
            minimumInputLength: 1,
            ajax: {
                url: '{{ $type == "healthcare"  ? route('healthcares.get_data') : route('patients.get_data')  }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(person) {
                            return {
                                id: person.id,
                                text: person.name + ' - phone: ' + person.phone + ' - Email: ' + person.email,
                                url: person.url
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            var url = e.params.data.url;
            if (url) {
                window.location.href = url; // Redirect to the URL associated with the selected option
            }
        });

    </script>
@endpush



