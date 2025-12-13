<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img class="light-logo img-fluid"
                src={{ asset('assets/images/logo/logo1.png') }} alt="logo" /><img class="dark-logo img-fluid"
                src={{ asset('assets/images/logo/logo-dark.png') }} alt="logo" /></a><a
            class="close-btn toggle-sidebar" href="javascript:void(0)">
            <svg class="svg-color">
                <use href="{{ asset('assets/svg/iconly-sprite.svg#Category') }}"></use>
            </svg></a></div>
    <div class="page-main-header col">
        <div class="header-left">
            {{-- <form class="form-inline search-full col" action="#" method="get">
              <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                  <div class="u-posRelative">
                    <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Admiro .." name="q" title="" autofocus="autofocus"/>
                    <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">{{(__('Loading...'))}}</span></div><i class="close-search" data-feather="x"></i>
                  </div>
                  <div class="Typeahead-menu"></div>
                </div>
              </div>
            </form>
            <div class="form-group-header d-lg-block d-none">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative d-flex align-items-center">
                  <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100" type="text" placeholder="Type to Search..." name="q" title=""/><i class="search-bg iconly-Search icli"></i>
                </div>
              </div>
            </div> --}}
        </div>
        <div class="nav-right">
            <ul class="header-right">
                <li class="custom-dropdown">
                    <div class="translate_wrapper">
                        <div class="current_lang d-flex align-items-center gap-2">
                            <a class="lang" href="javascript:void(0)"><i
                                    class="flag-icon {{ session('locale') === 'ar' ? 'flag-icon-sy' : 'flag-icon-us' }}"></i>
                                <h6 class="lang-txt f-w-700">{{ session('locale') === 'ar' ? __('AR') : __('EN') }}
                                </h6>
                            </a>
                        </div>
                        <ul class="custom-menu profile-menu language-menu py-0 more_lang">
                            <li class="d-block">
                                <form action="{{ route('settings.setLocale') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="locale" value="ar">
                                    <button type="submit"
                                        class="lang btn p-0 text-decoration-none d-flex align-items-center gap-2">
                                        <i class="flag-icon flag-icon-sy"></i>
                                        <span class="lang-txt text-uppercase mb-0">{{ __('AR') }}</span>
                                    </button>
                                </form>
                            </li>
                            <li class="d-block">
                                <form action="{{ route('settings.setLocale') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit"
                                        class="lang btn p-0 text-decoration-none d-flex align-items-center gap-2">
                                        <i class="flag-icon flag-icon-us"></i>
                                        <span class="lang-txt text-uppercase mb-0">{{ __('EN') }}</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="search d-lg-none d-flex"> <a href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#Search') }}"></use>
                        </svg></a></li>
                <li>
                    <form action="{{ route('settings.setMode') }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="mode"
                            value="{{ session('mode') === 'Dark' ? 'Light' : 'Dark' }}">
                        <button type="submit" class="dark-mode btn btn-link p-0">
                            <svg>
                                <use href="{{ asset('assets/svg/iconly-sprite.svg#moondark') }}"></use>
                            </svg>
                        </button>
                    </form>
                </li>

                <li><a class="full-screen" href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#scanfull') }}"></use>
                        </svg></a></li>

                <li class="profile-nav custom-dropdown">
                    <div class="user-wrap">

                        <div class="user-content">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p class="mb-0">{{ Auth::user()->email }}<i class="fa-solid fa-chevron-down"></i></p>
                        </div>
                    </div>
                    <div class="custom-menu overflow-hidden">
                        <ul class="profile-body">
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg#Profile') }}"></use>
                                </svg><a class="ms-2" href="#">{{ __('Account') }}</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg#Login') }}"></use>
                                </svg>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-link text-danger text-decoration-none text-nowrap">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
