<nav class="navbar navbar-expand-lg navCustom py-3 px-5">
    <div class="container-fluid">
        <div class="row align-items-center w-100 g-3 g-lg-0">
            <div class="col-12 col-lg-3 d-flex align-items-center justify-content-between navBrandCol">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}"><img class="logoC me-2"
                        src="{{ asset('media/logo1.png') }}" alt="Logo">CYBER MARKET</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-12 col-lg-9 navContentCol">
                <div class="collapse navbar-collapse navbarCollapseGrid" id="navbarSupportedContent">
                    <div class="row w-100 align-items-center g-3 g-lg-0">
                        <div class="col-12 col-lg-7 navPrimaryCol">
                            <ul class="navbar-nav ulCustom justify-content-center navPrimary">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                        href="{{ route('home') }}" aria-current="page">Home</a>
                                </li>

                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('create/article') ? 'active' : '' }}"
                                            href="{{ route('create.article') }}" aria-current="page">{{ __("ui.createArticle") }}
                                        </a>
                                    </li>
                                @endauth

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('article/index') ? 'active' : '' }}"
                                        href="{{ route('article.index') }}"
                                        aria-current="page">{{ __('ui.allArticles') }}

                                    </a>
                                </li>

                                {{-- DROPDOWN CATEGORIE --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('ui.categories') }}

                                    </a>
                                    <ul class="dropdown-menu dropdownCustom">
                                        @foreach ($categories ?? [] as $category)
                                            <li><a class="dropdown-item text-capitalize"
                                                    href="{{ route('byCategory', ['category' => $category]) }}">{{ __('ui.' . $category->name) }}</a>
                                            </li>
                                            @if (!$loop->last)
                                                <hr class="dropdown-divider">
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        {{-- DROPDOWN LOGOUT --}}
                        <div class="col-12 col-lg-5 navActionsCol">
                            <ul class="navbar-nav ulCustom justify-content-end navActions">
                                @auth

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('work.with.us') }}">{{ __('ui.workWithUs') }}</a>
                                    </li>


                                    @if (Auth::user()->is_revisor)
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('revisor/index') ? 'active' : '' }} btn btn-sm w-sm-25"
                                                href="{{ route('revisor.index') }}">{{ __('ui.revisorZone') }}
                                            </a>
                                        </li>
                                    @endif

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle loginCustom" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end cz-dropdown dropdownCustom">
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth

                                {{-- DROPDOWN LOGIN/REGISTRAZIONE --}}
                                @guest
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-user" style="color: rgb(255, 255, 255);"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdownCustom">
                                            <li><a class="dropdown-item" href="{{ route('login') }}">Accedi</a></li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a>
                                            </li>

                                        </ul>
                                    </li>
                                @endguest
                                {{-- CAMBIO LINGUA --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-earth-americas" style="color: rgb(255, 255, 255);"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdownCustom dropdown-menu-end text-center">
                                        <x-_locale lang="it" />
                                        <hr class="dropdown-divider">
                                        <x-_locale lang="en" />
                                        <hr class="dropdown-divider">
                                        <x-_locale lang="es" />
                                    </ul>
                                </li>

                                {{-- BARRA DI RICERCA --}}
                                <li class="nav-item">
                                    <button type="button" id="open-search" class="btn navSearchBtn">
                                        <i class="fa-brands fa-sistrix fa-2x" style="color: rgb(255, 255, 255);"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="search-overlay" class="search-overlay">
                    <div class="container d-flex align-items-center h-100">
                        <form class="d-flex ms-auto w-75" action="{{ route('article.search') }}" method="GET">
                            <div class="input-group">
                                <input type="search" name="query" class="form-control formSearch"
                                    placeholder="Cerca un articolo...">
                                <button class="btn" type="submit"><i class="fa-brands fa-sistrix fa-2x"
                                        style="color: rgb(255, 255, 255);"></i></button>
                            </div>
                        </form>
                        <button type="button" id="close-search" class="btn ms-auto">
                            <i class="fa-solid fa-xmark" style="color: white; font-size: 25px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
