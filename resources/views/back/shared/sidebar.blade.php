<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link">
            <img src="{{ $config->getFirstMediaUrl('images') }}"  class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
        </a>

        <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden">
            <div class="os-resize-observer-host observed">
                <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
            </div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                <div class="os-resize-observer"></div>
            </div>
            <div class="os-padding">
                <div class="os-viewport os-viewport-native-scrollbars-invisible" style="">
                    <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">

                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                            <div class="info">
                                <a href="#" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                            </div>
                        </div>

                        <div class="form-inline">
                            <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-sidebar">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
                        </div>

                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                @can('user-index')
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="fas fa-angle-left right"></i>
                                            <p>@lang("Gestion des utilisateurs")</p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('users.index') }}" class="nav-link">
                                                    <i class="fa fa-users"></i>
                                                    <p>@lang("Gestion des utilisateurs")</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('healthcare-entity-index')
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="fas fa-hand-holding-medical right"></i>
                                                <p>@lang("Healthcare entities")</p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @foreach(\App\Models\HealthcareEntity::Types as $key => $value)
                                                    <li class="nav-item">
                                                        <a href="{{ route('healthcareEntity.index' , $key) }}" class="nav-link">
                                                            <i class="fa fa-chevron-right fa-xs"></i>
                                                            <p> @lang($value) Management</p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                                    <li class="nav-item">
                                                        <a href="{{ route('services.index' ,  'healthcare') }}" class="nav-link">
                                                            <i class="fa fa-chevron-right fa-xs"></i>
                                                            <p>Service Management</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('services.index' , 'labo' ) }}" class="nav-link">
                                                            <i class="fa fa-chevron-right fa-xs"></i>
                                                            <p>lab-service Management</p>
                                                        </a>
                                                    </li>
                                            </ul>
                                        </li>
                                @endcan
                                    @can('patient-index')
                                        <li class="nav-item">
                                            <a href="{{ route('patients.index') }}" class="nav-link">
                                                <i class="fa fa-hospital-user right"></i>
                                                <p>@lang("Patients Management")</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('blood.donors.index') }}" class="nav-link">
                                                <i class="fa fa-syringe right"></i>
                                                <p>@lang("Listing Blood Donors")</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('diseases.index') }}" class="nav-link">
                                                <i class="fa fa-disease right"></i>
                                                <p>@lang("Listing diseases")</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('healthcareEntity.vouchers') }}" class="nav-link">
                                                <i class="fa fa-money-bill right"></i>
                                                <p>@lang("Healthcare Billing")</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('pricings.index') }}" class="nav-link">
                                                <i class="fa fa-money-check right"></i>
                                                <p>@lang("Pricing Subscription")</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('appoin-index')
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="fas fa-calendar-check right"></i>
                                                <p>@lang("Appointments")</p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @foreach(\App\Models\Appointment::types as $value )
                                                    <li class="nav-item">
                                                        <a href="{{ route('appointment.index' , $value) }}" class="nav-link">
                                                            <i class="fa fa-chevron-right fa-xs"></i>
                                                            <p> @lang($value) Management</p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endcan
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="fas fa-newspaper right"></i>
                                            <p>@lang("Timeline")</p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @foreach(\App\Models\Article::Section as $value )
                                                <li class="nav-item">
                                                    <a href="{{ route('article.index' , $value) }}" class="nav-link">
                                                        <i class="fa fa-chevron-right fa-xs"></i>
                                                        <p> @lang($value) Management</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                @can('edit-config')
                                        <li class="nav-item">
                                            <a href="{{ route('edit_config') }}" class="nav-link">
                                                <i class="fa fa-cog right"></i>
                                                <p>@lang("Configuration")</p>
                                            </a>
                                        </li>
                                    @endcan
                                    <li class="nav-item">
                                        <a href="{{ route('logout') }}" class="nav-link">
                                            <i class="fas fa-door-open right"></i>
                                            <p>@lang("Déconnecter")</p>
                                        </a>
                                    </li>
                            </ul>
                        </nav>
            </div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden os-scrollbar-unusable">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="height: 100%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar-corner"></div>
        </div>
    </aside>
