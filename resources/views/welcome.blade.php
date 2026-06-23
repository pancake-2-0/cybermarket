<x-layout>
    {{-- Sezione Hero --}}
    <div class="hero-cyber-section">
        {{-- Overlay per la leggibilità: scurisce solo dove serve il testo --}}
        <div class="hero-readability-overlay"></div>

        <div class="container-fluid h-100 position-relative z-index-content">
            <div class="row h-100 align-items-center px-lg-5">

                {{-- COLONNA TESTO --}}
                <div class="col-12 col-lg-5">
                    <div class="hero-content-box">

                        {{-- Gestione Messaggi di Errore/Successo --}}
                        <div class="alert-wrapper mb-4">
                            @if (session()->has('errorMessage'))
                                <div class="alert alert-danger alert-dismissible fade show cyber-alert">
                                    {{ session('errorMessage') }}
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show cyber-alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>

                        <p class="hero-kicker ps-5">MARKETPLACE CYBERPUNK</p>
                        <h1 class="hero-main-title ps-5">CYBER MARKET</h1>

                        <div class="hero-slogan-container ps-5">
                            <h2 class="hero-slogan-lead">Esplora il mercato.<br>Pubblica il tuo stile.</h2>
                            <p class="hero-slogan-sub">
                                Tech, accessori e setup in un marketplace dal carattere neon,
                                pensato per chi vuole comprare e vendere con un'identità forte.
                            </p>
                        </div>

                        <div class="hero-cta-group ps-5">
                            <a href="{{ route('article.index') }}" class="btn-cyber primary">ESPLORA ARTICOLI</a>

                            @auth
                                <a href="{{ route('create.article') }}" class="btn-cyber outline">PUBBLICA ARTICOLO</a>
                            @else
                                <a href="{{ route('register') }}" class="btn-cyber outline">UNISCITI ORA</a>
                            @endauth
                        </div>

                        <div class="hero-tags-minimal mt-5 ps-5">
                            <span>#CyberTech</span>
                            <span>#StreetWear</span>
                            <span>#NeonLiving</span>
                        </div>
                    </div>
                </div>

                {{-- COLONNA LOGO --}}
                <div class="col-12 col-lg-5 d-none d-lg-flex justify-content-center">
                    <div class="hero-logo-visual">
                        <img src="{{ asset('media/logo1.png') }}" alt="Logo Cyber Market"
                            class="img-fluid floating-logo">
                        <div class="logo-glow-effect"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- CARD ARTICOLI --}}
    <div class="container">
        <div class="row height-custom justify-content-center align-items-center py-5">
            <h1 class="heroTitle2 text-center mb-5">Gli ultimi articoli</h1>
            @forelse ($articles as $article)
                <div class="col-12 col-md-4 my-3">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">Non sono ancora stati creati articoli</h3>
                </div>
            @endforelse
        </div>
    </div>
    </div>

    <!-- INIZIO BUTTON TORNA SU -->

    <a href="#" id="tornaSu"><i class="fa-solid fa-circle-chevron-up fa-3x" style="color: #ff008c;"></i></a>

    <!-- FINE BUTTON TORNA SU -->
</x-layout>
