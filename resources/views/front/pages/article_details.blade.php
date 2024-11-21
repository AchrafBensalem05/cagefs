@extends('front.layout')


@section('header')

@endsection


@section('content')
    <div class="hero">
        <div class="top-fixed-menu">
            <form action="{{ url()->current() }}">
                <div class="top-fixed-menu-container">
                    <button class="tp-fxd-buttons tp-fxd-email-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -1 20 21"><path fill-rule="evenodd" d="m7.172 11.334l2.83 1.935l2.728-1.882l6.115 6.033c-.161.052-.333.08-.512.08H1.667c-.22 0-.43-.043-.623-.12l6.128-6.046ZM20 6.376v9.457c0 .247-.054.481-.15.692l-5.994-5.914L20 6.376ZM0 6.429l6.042 4.132l-5.936 5.858A1.663 1.663 0 0 1 0 15.833V6.43ZM18.333 2.5c.92 0 1.667.746 1.667 1.667v.586L9.998 11.648L0 4.81v-.643C0 3.247.746 2.5 1.667 2.5h16.666Z"/></svg>
                    </button>
                    <input type="search" class="tp-fxd-buttons tp-fxd-search-btn text-white" name="q"  value="{{ request()->get("q") }}">
                    <button class="tp-fxd-buttons tp-fxd-notificatio-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3ZM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8a124.95 124.95 0 0 1-124.8-124.8Z"></path></svg>
                    </button>
                    <button class="tp-fxd-buttons tp-fxd-saved-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1m-1 11h-5v5h5v-5Z"/></svg>
                    </button>
                    <button class="tp-fxd-buttons tp-fxd-filtre-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.875 22h-3.75q-.375 0-.65-.25t-.325-.625l-.3-2.325q-.325-.125-.613-.3t-.562-.375l-2.175.9q-.35.125-.7.025t-.55-.425L2.4 15.4q-.2-.325-.125-.7t.375-.6l1.875-1.425Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L2.65 9.9q-.3-.225-.375-.6t.125-.7l1.85-3.225q.175-.35.537-.438t.713.038l2.175.9q.275-.2.575-.375t.6-.3l.3-2.325q.05-.375.325-.625t.65-.25h3.75q.375 0 .65.25t.325.625l.3 2.325q.325.125.613.3t.562.375l2.175-.9q.35-.125.7-.025t.55.425L21.6 8.6q.2.325.125.7t-.375.6l-1.875 1.425q.025.175.025.338v.674q0 .163-.05.338l1.875 1.425q.3.225.375.6t-.125.7l-1.85 3.2q-.2.325-.563.438t-.712-.013l-2.125-.9q-.275.2-.575.375t-.6.3l-.3 2.325q-.05.375-.325.625t-.65.25Zm-1.825-6.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.012 2.475T12.05 15.5Z"/></svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="left-fixed-menu">

        </div>
        <div class="timeline">
            @if(flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif

            @if($article->section == 'medication')
                    <div class="announces">
                        @switch($article->medication_type)
                            @case("search")
                                <div class="post-type search-posts">
                                    <div class="search-tickt">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3ZM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8a124.95 124.95 0 0 1-124.8-124.8Z"></path></svg>
                                        <span>search</span>
                                    </div>
                                </div>
                                @break
                            @case("offer")
                                <div class="post-type donate-posts">
                                    <div class="donate-tickt">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"><path d="M10.5 1.002a3 3 0 0 0-3 2.25a3 3 0 0 0-3-2.25C2.768.947 2.235 2.797 2.818 4H1.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.306c.606-1.185.098-2.999-1.654-2.999h-.04ZM10.683 4H8.5a2 2 0 0 1 2-1.998c1.175 0 1.383 1.872.183 1.998ZM6.5 4H4.292c-1.035-.117-1.096-1.894.04-1.998a.921.921 0 0 1 .168 0A2 2 0 0 1 6.5 4ZM2 7.001v4.5a1.5 1.5 0 0 0 1.5 1.5h3v-6H2Zm6.5 0v6h3a1.5 1.5 0 0 0 1.5-1.5v-4.5H8.5Z"></path></svg>
                                        <span>donate</span>
                                    </div>
                                </div>
                                @break

                            @default

                        @endswitch

                        <div class="header">
                            <div class="announcer-user-photo">
                                <img src="{{  optional($article->user)->getFirstMediaUrl('avatar' , 'thumb')  }}" alt="">
                            </div>
                            <div class="post-info">
                                <div class="user-name">
                                    <span>{{ optional($article->user)->fname . ' | '. optional($article->user)->lname }}</span>
                                </div>
                                <div class="informations">
                                    <span>{{ optional($article->wilaya_rel)->name . ' | ' . optional($article->daira_rel)->name  }}</span>
                                    <span>&#9679</span>

                                    , <span>@lang($article->area)</span>
                                </div>
                            </div>
                        </div>
                        <div class="announces-container">
                            <div class="announces-description">
                        <span>
                           {{ $article->content }}
                        </span>
                            </div>
                            <div class="announces-img">
                                @foreach($article->getMedia('gallery') as $file)
                                    @if($loop->index + 1 == 1 )
                                        <div class="img-dv img-{{ $loop->index +1 }}">
                                            <img src="{{ $file->getUrl('main') }}" alt="">
                                        </div>
                                    @else
                                        <div class="img-dv img-{{ $loop->index +1 }}">
                                            <img src="{{ $file->getUrl('square') }}" alt="">
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="announces-position-type">
                                <div class="location-blood-announce">
                                    <div id="map{{ $article->id }}" style="width: 100%;height: 100%"></div>
                                </div>
                                <div class="type-blood-announce-indice">
                                    @switch($article->blood)
                                        @case("O+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M14 18a6 6 0 1 1 12 0a6 6 0 0 1-12 0Zm6-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8Z" clip-rule="evenodd"></path><path d="M28 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H33a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H28Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("O-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 12a6 6 0 1 0 0 12a6 6 0 0 0 0-12Zm-4 6a4 4 0 1 1 8 0a4 4 0 0 1-8 0Z" clip-rule="evenodd"></path><path d="M27 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("B+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M15 12a1 1 0 0 1 1-1h5a4 4 0 0 1 2.646 7A4 4 0 0 1 21 25h-5a1 1 0 0 1-1-1V12Zm6 5a2 2 0 1 0 0-4h-4v4h4Zm2 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Z" clip-rule="evenodd"></path><path d="M27 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H32a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H27Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("B-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M16 11a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h5a4 4 0 0 0 2.646-7A4 4 0 0 0 21 11h-5Zm7 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Zm0 6a2 2 0 0 0-2-2h-4v4h4a2 2 0 0 0 2-2Z" clip-rule="evenodd"></path><path d="M26 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M34 38c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4ZM26.571 7.758a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("A+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 10a1 1 0 0 1 .923.615l3.742 8.98l.017.042l1.241 2.978a1 1 0 0 1-1.846.77L23.083 21h-6.166l-.994 2.385a1 1 0 0 1-1.846-.77l1.241-2.978l.018-.042l3.74-8.98A1 1 0 0 1 20 10Zm2.25 9L20 13.6L17.75 19h4.5Z" clip-rule="evenodd"></path><path d="M27 16a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2a1 1 0 1 0-2 0v2h-2Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("A-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20.923 10.615a1 1 0 0 0-1.846 0l-3.742 8.98a1.036 1.036 0 0 0-.017.042l-1.241 2.978a1 1 0 0 0 1.846.77L16.917 21h6.166l.994 2.385a1 1 0 0 0 1.846-.77l-1.241-2.978a1.036 1.036 0 0 0-.017-.042l-3.742-8.98ZM20 13.6l2.25 5.4h-4.5L20 13.6Z" clip-rule="evenodd"></path><path d="M26 17a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("AB-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M20.388 5.535a5.018 5.018 0 0 1 7.224 0l.528.548h5.19c2.573 0 4.67 2.074 4.67 4.646V15.5h-2v-4.771a2.658 2.658 0 0 0-2.67-2.646h-5.616a1 1 0 0 1-.72-.307l-.823-.855a3.018 3.018 0 0 0-4.342 0l-.823.855a1 1 0 0 1-.72.307H15c-1.663 0-3 1.338-3 2.974V28.97a68.776 68.776 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V22.5h2v10.526C38 35.78 35.755 38 33 38h-3v2h-5v4h-2v-4h-5v-2h-3c-2.755 0-5-2.22-5-4.974v-21.97c0-2.752 2.245-4.973 5-4.973h4.86l.528-.548Z"></path><path fill-rule="evenodd" d="M19.416 14.6a1 1 0 0 0-1.832 0l-2.616 5.98a.998.998 0 0 0-.018.04l-.866 1.98a1 1 0 0 0 1.832.8l.613-1.4h3.942l.613 1.4a1 1 0 0 0 1.832-.8l-.866-1.98a.998.998 0 0 0-.018-.04l-2.616-5.98Zm-.916 2.895L19.596 20h-2.192l1.096-2.505ZM24 15a1 1 0 0 1 1-1h3.125C29.773 14 31 15.405 31 17a3.09 3.09 0 0 1-.732 2c.46.54.732 1.249.732 2c0 1.595-1.227 3-2.875 3H25a1 1 0 0 1-1-1v-8Zm4.125 3c.423 0 .875-.386.875-1s-.452-1-.875-1H26v2h2.125ZM29 21c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Z" clip-rule="evenodd"></path><path d="M34 18a1 1 0 1 0 0 2h3a1 1 0 0 0 0-2h-3Z"></path></g></svg>
                                            @break
                                        @case("AB+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M27.612 5.535a5.018 5.018 0 0 0-7.224 0l-.528.548H15c-2.755 0-5 2.22-5 4.974v21.97C10 35.778 12.245 38 15 38h3v2h5v4h2v-4h5v-2h3c2.755 0 5-2.22 5-4.974V23h-2v4.539a8.442 8.442 0 0 0-.925-.626c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.17.025-2.368-.02-3.65-.069l-.531-.02A68.776 68.776 0 0 0 12 28.97V11.058c0-1.636 1.337-2.974 3-2.974h5.286a1 1 0 0 0 .72-.307l.823-.855a3.018 3.018 0 0 1 4.342 0l.823.855a1 1 0 0 0 .72.307h5.616c1.48 0 2.67 1.19 2.67 2.646V15h2v-4.271c0-2.572-2.097-4.646-4.67-4.646h-5.19l-.528-.548Z"></path><path fill-rule="evenodd" d="M18.5 14a1 1 0 0 1 .916.6l2.616 5.98a.998.998 0 0 1 .018.04l.866 1.98a1 1 0 0 1-1.832.8L20.47 22h-3.942l-.613 1.4a1 1 0 0 1-1.832-.8l.866-1.98l.002-.005a.887.887 0 0 1 .016-.036l2.616-5.98A1 1 0 0 1 18.5 14Zm1.096 6L18.5 17.495L17.404 20h2.192ZM25 14a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h3.125C29.773 24 31 22.595 31 21a3.09 3.09 0 0 0-.732-2A3.09 3.09 0 0 0 31 17c0-1.595-1.227-3-2.875-3H25Zm4 3c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Zm0 4c0-.614-.452-1-.875-1H26v2h2.125c.423 0 .875-.386.875-1Z" clip-rule="evenodd"></path><path d="M32 19a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1-1-1Z"></path></g></svg>
                                            @break

                                        @default
                                    @endswitch


                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($article->section == 'blood')
                    <div class="announces">
                        @switch($article->emergency)
                            @case("very very urgent")
                                <div class="post-type v-v-ergent-post">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 14q0-2.625 1.25-4.675T7 5.875q1.5-1.4 2.75-2.138L11 3v3.3q0 .925.625 1.462t1.4.538q.425 0 .813-.175t.712-.575L15 7q1.8 1.05 2.9 2.912T19 14q0 2.2-1.075 4.013T15.1 20.874q.425-.6.663-1.313T16 18.05q0-1-.375-1.888t-1.075-1.587L11 11.1l-3.525 3.475q-.725.725-1.1 1.6T6 18.05q0 .8.238 1.513t.662 1.312q-1.75-1.05-2.825-2.863T3 14Zm8-.1l2.125 2.075q.425.425.65.95T14 18.05q0 1.225-.875 2.087T11 21q-1.25 0-2.125-.863T8 18.05q0-.575.225-1.113t.65-.962L11 13.9ZM21 11q-.425 0-.713-.288T20 10q0-.425.288-.713T21 9q.425 0 .713.288T22 10q0 .425-.288.713T21 11Zm-1-3V3h2v5h-2Z"/></svg>
                                    <span>very very urgent</span>
                                </div>
                                @break
                            @case("very urgent")
                                <div class="post-type v-ergent-post">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 20v-2h1.6l1.975-6.575q.2-.65.738-1.038T10.5 10h3q.65 0 1.188.388t.737 1.037L17.4 18H19v2H5Zm6-12V3h2v5h-2Zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4l-3.525 3.55ZM18 15v-2h5v2h-5ZM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525l-1.425 1.425ZM1 15v-2h5v2H1Z"/></svg>
                                    <span>very urgent</span>
                                </div>
                                @break
                            @case("urgent")
                                <div class="post-type ergent-post">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22.025q-.4 0-.763-.15t-.662-.425L2.55 13.425q-.275-.3-.425-.663T1.975 12q0-.4.15-.775t.425-.65l8.025-8.025q.3-.3.663-.438T12 1.975q.4 0 .775.138t.65.437l8.025 8.025q.3.275.438.65t.137.775q0 .4-.137.763t-.438.662l-8.025 8.025q-.275.275-.65.425t-.775.15ZM11 13h2V7h-2v6Zm1 3q.425 0 .713-.288T13 15q0-.425-.288-.713T12 14q-.425 0-.713.288T11 15q0 .425.288.713T12 16Z"/></svg>
                                    <span>urgent</span>
                                </div>
                                @break
                            @case("for storage")
                                <div class="post-type storage-post">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 7c-1 0-1-1-1-1V5h-2v2h-2V6c0-1.73-1.25-5-6-5S4 4.27 4 6v13c0 .33-.1 2-2 2v2c2.93 0 4-2.39 4-4V6c0-.12.05-3 4-3c3.83 0 4 2.7 4 3v1h-2V5h-2v1s0 1-1 1s-1 1-1 1v12s0 2 5 2h4c5 0 5-2 5-2V8s0-1-1-1m-6 12.4a3 3 0 0 1-3-3c0-2 3-5.4 3-5.4s3 3.4 3 5.4a3 3 0 0 1-3 3Z"/></svg>
                                    <span>for storage</span>
                                </div>
                                @break

                            @default

                        @endswitch

                        <div class="header">
                            <div class="announcer-user-photo">
                                <img src="{{  optional($article->user)->getFirstMediaUrl('avatar' , 'thumb')  }}" alt="">
                            </div>
                            <div class="post-info">
                                <div class="user-name">
                                    <span>{{ optional($article->user)->fname . ' | '. optional($article->user)->lname }}</span>
                                </div>
                                <div class="informations">
                                    <span>{{ optional($article->wilaya_rel)->name . ' | ' . optional($article->daira_rel)->name  }}</span>
                                    <span>&#9679</span>
                                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="announces-container">
                            <div class="announces-description">
                        <span>
                           {{ $article->content }}
                        </span>
                            </div>
                            <div class="announces-position-type">
                                <div class="location-blood-announce">
                                    <div id="map{{ $article->id }}" style="width: 100%;height: 100%"></div>
                                </div>
                                <div class="type-blood-announce-indice">
                                    @switch($article->blood)
                                        @case("O+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M14 18a6 6 0 1 1 12 0a6 6 0 0 1-12 0Zm6-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8Z" clip-rule="evenodd"></path><path d="M28 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H33a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H28Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("O-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 12a6 6 0 1 0 0 12a6 6 0 0 0 0-12Zm-4 6a4 4 0 1 1 8 0a4 4 0 0 1-8 0Z" clip-rule="evenodd"></path><path d="M27 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("B+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M15 12a1 1 0 0 1 1-1h5a4 4 0 0 1 2.646 7A4 4 0 0 1 21 25h-5a1 1 0 0 1-1-1V12Zm6 5a2 2 0 1 0 0-4h-4v4h4Zm2 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Z" clip-rule="evenodd"></path><path d="M27 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H32a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H27Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("B-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M16 11a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h5a4 4 0 0 0 2.646-7A4 4 0 0 0 21 11h-5Zm7 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Zm0 6a2 2 0 0 0-2-2h-4v4h4a2 2 0 0 0 2-2Z" clip-rule="evenodd"></path><path d="M26 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M34 38c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4ZM26.571 7.758a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("A+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 10a1 1 0 0 1 .923.615l3.742 8.98l.017.042l1.241 2.978a1 1 0 0 1-1.846.77L23.083 21h-6.166l-.994 2.385a1 1 0 0 1-1.846-.77l1.241-2.978l.018-.042l3.74-8.98A1 1 0 0 1 20 10Zm2.25 9L20 13.6L17.75 19h4.5Z" clip-rule="evenodd"></path><path d="M27 16a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2a1 1 0 1 0-2 0v2h-2Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("A-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20.923 10.615a1 1 0 0 0-1.846 0l-3.742 8.98a1.036 1.036 0 0 0-.017.042l-1.241 2.978a1 1 0 0 0 1.846.77L16.917 21h6.166l.994 2.385a1 1 0 0 0 1.846-.77l-1.241-2.978a1.036 1.036 0 0 0-.017-.042l-3.742-8.98ZM20 13.6l2.25 5.4h-4.5L20 13.6Z" clip-rule="evenodd"></path><path d="M26 17a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                        @case("AB-")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M20.388 5.535a5.018 5.018 0 0 1 7.224 0l.528.548h5.19c2.573 0 4.67 2.074 4.67 4.646V15.5h-2v-4.771a2.658 2.658 0 0 0-2.67-2.646h-5.616a1 1 0 0 1-.72-.307l-.823-.855a3.018 3.018 0 0 0-4.342 0l-.823.855a1 1 0 0 1-.72.307H15c-1.663 0-3 1.338-3 2.974V28.97a68.776 68.776 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V22.5h2v10.526C38 35.78 35.755 38 33 38h-3v2h-5v4h-2v-4h-5v-2h-3c-2.755 0-5-2.22-5-4.974v-21.97c0-2.752 2.245-4.973 5-4.973h4.86l.528-.548Z"></path><path fill-rule="evenodd" d="M19.416 14.6a1 1 0 0 0-1.832 0l-2.616 5.98a.998.998 0 0 0-.018.04l-.866 1.98a1 1 0 0 0 1.832.8l.613-1.4h3.942l.613 1.4a1 1 0 0 0 1.832-.8l-.866-1.98a.998.998 0 0 0-.018-.04l-2.616-5.98Zm-.916 2.895L19.596 20h-2.192l1.096-2.505ZM24 15a1 1 0 0 1 1-1h3.125C29.773 14 31 15.405 31 17a3.09 3.09 0 0 1-.732 2c.46.54.732 1.249.732 2c0 1.595-1.227 3-2.875 3H25a1 1 0 0 1-1-1v-8Zm4.125 3c.423 0 .875-.386.875-1s-.452-1-.875-1H26v2h2.125ZM29 21c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Z" clip-rule="evenodd"></path><path d="M34 18a1 1 0 1 0 0 2h3a1 1 0 0 0 0-2h-3Z"></path></g></svg>
                                            @break
                                        @case("AB+")
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M27.612 5.535a5.018 5.018 0 0 0-7.224 0l-.528.548H15c-2.755 0-5 2.22-5 4.974v21.97C10 35.778 12.245 38 15 38h3v2h5v4h2v-4h5v-2h3c2.755 0 5-2.22 5-4.974V23h-2v4.539a8.442 8.442 0 0 0-.925-.626c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.17.025-2.368-.02-3.65-.069l-.531-.02A68.776 68.776 0 0 0 12 28.97V11.058c0-1.636 1.337-2.974 3-2.974h5.286a1 1 0 0 0 .72-.307l.823-.855a3.018 3.018 0 0 1 4.342 0l.823.855a1 1 0 0 0 .72.307h5.616c1.48 0 2.67 1.19 2.67 2.646V15h2v-4.271c0-2.572-2.097-4.646-4.67-4.646h-5.19l-.528-.548Z"></path><path fill-rule="evenodd" d="M18.5 14a1 1 0 0 1 .916.6l2.616 5.98a.998.998 0 0 1 .018.04l.866 1.98a1 1 0 0 1-1.832.8L20.47 22h-3.942l-.613 1.4a1 1 0 0 1-1.832-.8l.866-1.98l.002-.005a.887.887 0 0 1 .016-.036l2.616-5.98A1 1 0 0 1 18.5 14Zm1.096 6L18.5 17.495L17.404 20h2.192ZM25 14a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h3.125C29.773 24 31 22.595 31 21a3.09 3.09 0 0 0-.732-2A3.09 3.09 0 0 0 31 17c0-1.595-1.227-3-2.875-3H25Zm4 3c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Zm0 4c0-.614-.452-1-.875-1H26v2h2.125c.423 0 .875-.386.875-1Z" clip-rule="evenodd"></path><path d="M32 19a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1-1-1Z"></path></g></svg>
                                            @break

                                        @default
                                    @endswitch


                                </div>
                            </div>
                        </div>
                        <div class="announces-nav-buttons">
                            <!---love icon---->
                            <div class="nav-btn-dv love-announces-dv">
                                <a href="{{  route('patient.like_article' ,['like' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->likes->pluck('user_id')->toArray())) style="fill: red" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m8 14.25l.345.666a.75.75 0 0 1-.69 0l-.008-.004l-.018-.01a7.152 7.152 0 0 1-.31-.17a22.055 22.055 0 0 1-3.434-2.414C2.045 10.731 0 8.35 0 5.5C0 2.836 2.086 1 4.25 1C5.797 1 7.153 1.802 8 3.02C8.847 1.802 10.203 1 11.75 1C13.914 1 16 2.836 16 5.5c0 2.85-2.045 5.231-3.885 6.818a22.066 22.066 0 0 1-3.744 2.584l-.018.01l-.006.003h-.002ZM4.25 2.5c-1.336 0-2.75 1.164-2.75 3c0 2.15 1.58 4.144 3.365 5.682A20.58 20.58 0 0 0 8 13.393a20.58 20.58 0 0 0 3.135-2.211C12.92 9.644 14.5 7.65 14.5 5.5c0-1.836-1.414-3-2.75-3c-1.373 0-2.609.986-3.029 2.456a.749.749 0 0 1-1.442 0C6.859 3.486 5.623 2.5 4.25 2.5Z"/></svg>
                                </a>
                            </div>
                            <!---messeger icon---->
                            <div class="nav-btn-dv chat-announces-dv">
                                <a href="{{ route('patient.get_my_chat_page' , ['type' => 'patient' , 'current' => $article->author_id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="2 2 22 22"><path d="m14.777 14.038l2.65-3.92c.262-.386-.235-.805-.615-.529l-2.858 2.015a.571.571 0 0 1-.652 0l-2.116-1.477c-.633-.437-1.538-.277-1.963.335l-2.65 3.92c-.262.386.235.806.615.529l2.858-2.015a.571.571 0 0 1 .652 0l2.116 1.452c.633.462 1.538.302 1.963-.31Z"/><path fill="currentColor" fill-rule="evenodd" d="M12 2.25A9.75 9.75 0 0 0 2.25 12a9.724 9.724 0 0 0 3 7.036V21.5a.75.75 0 0 0 .987.712l2.78-.927A9.745 9.745 0 0 0 12 21.75c5.385 0 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM3.75 12a8.25 8.25 0 1 1 5.516 7.787a.75.75 0 0 0-.486-.004l-2.03.676v-1.75a.75.75 0 0 0-.25-.56A8.228 8.228 0 0 1 3.75 12Z" clip-rule="evenodd"/></svg>
                                </a>
                            </div>
                            <!---save icon---->
                            <div class="nav-btn-dv save-announces-dv">
                                <a href="{{  route('patient.like_article' ,['favorite' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->favorites->pluck('user_id')->toArray())) style="fill: red" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 2H8a3 3 0 0 0-3 3v16a1 1 0 0 0 .5.87a1 1 0 0 0 1 0l5.5-3.18l5.5 3.18a1 1 0 0 0 .5.13a1 1 0 0 0 .5-.13A1 1 0 0 0 19 21V5a3 3 0 0 0-3-3Zm1 17.27l-4.5-2.6a1 1 0 0 0-1 0L7 19.27V5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1Z"/></svg>
                                </a>
                            </div>
                            <!---report icon---->
                            <div class="nav-btn-dv report-announces-dv">
                                <a href="{{  route('patient.like_article' ,['report' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->reports->pluck('user_id')->toArray())) style="fill: red" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="1 1 20 20"><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM19 14.9L14.9 19H9.1L5 14.9V9.1L9.1 5h5.8L19 9.1v5.8z"/><path fill="currentColor" d="M11 7h2v6h-2zm0 8h2v2h-2z"/></svg>
                                </a>
                            </div>

                        </div>
                    </div>
            @endif


        </div>
        <div class="right-fixed-menu">

        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    @if($article->section == 'blood')
        <link rel="stylesheet" href="{{asset('theme/css/blood-search-timeline-styles.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('theme/css/medicatim-search-timeline-styles.css')}}">
    @endif
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        /* Style for the custom select container */
        .custom-select {
            position: relative;
            display: inline-block;
        }

        /* Hide the default select dropdown arrow */
        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: transparent;
            padding: 5px 30px 5px 10px; /* Adjust padding as needed */
            border: 1px solid #ccc; /* Add a border for styling */
            cursor: pointer;
        }

        /* Style for the custom arrow or image */
        .custom-select::after {
            content: url('arrow.png'); /* Replace 'arrow.png' with the path to your image */
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        @media screen and (max-width:700px) {
            .w-sm-100{
                width: 100%;
            }
        }

        .form-control{
            height: auto;
        }
    </style>

@endpush
@push('after-scripts')
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $('.wilaya_select').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira]');
                daira_select.empty();
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })

        $('select[name=wilaya_id]').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira_id]');
                daira_select.empty();
                daira_select.append(`<option value="*">All</option>`)
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })


        $("#gallery").on("change", function(e) {
            if (($("#gallery")[0].files.length <  3) ||  ($("#gallery")[0].files.length >  5)  ) {
                alert("Upload at least 4 items");
                $("#gallery").val("");
            }
        });

        $('input[type="text"][name=created_at]').daterangepicker({
            maxDate:moment().startOf('day'),
            startDate: @if(request()->get('created_at')) {{ request()->get('created_at') }} @else moment().startOf('month').subtract(10, 'months') @endif,
            ranges: {
                'Aujourdhui': [moment(), moment()],
                'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Derniers 7 jours': [moment().subtract(6, 'days'), moment()],
                'Derniers 30 jours': [moment().subtract(29, 'days'), moment()],
                'Ce mois': [moment().startOf('month'), moment().endOf('month')],
                'Dernier mois': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns:true,
            alwaysShowCalendars:true,
            onClose: function() {
                $(this).removeClass("hasDatepicker");
            }
        })

    </script>
@endpush






