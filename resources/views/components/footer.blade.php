<footer class="footerCustom mt-5">
    <div class="container py-5">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-4">
                <a class="footerBrand d-inline-flex align-items-center text-decoration-none mb-3"
                    href="{{ route('home') }}">
                    <img class="logoC me-2" src="{{ asset('media/logo1.png') }}" alt="Logo Cyber Market">
                    <span>CYBER MARKET</span>
                </a>
                <p class="footerText mb-0">
                    Marketplace tech con anima cyber: annunci, community e nuove opportunita in un unico spazio.
                </p>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="footerTitle mb-3">Navigazione</h5>
                <ul class="list-unstyled footerLinks mb-0">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('article.index') }}">{{ __('ui.allArticles') }}</a></li>
                    @auth
                        <li><a href="{{ route('create.article') }}">Crea articolo</a></li>
                    @endauth
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-5">
                <h5 class="footerTitle mb-3">Collabora con noi</h5>
                <p class="footerText mb-3">
                    Vuoi diventare revisore? Invia la tua richiesta e unisciti al team.
                </p>
                <a href="{{ route('work.with.us') }}" class="btn btnFooter">Diventa revisore</a>
            </div>
        </div>
    </div>

    <div class="footerBottom">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 py-3">
            <small>&copy; {{ now()->year }} Cyber Market. Tutti i diritti riservati.</small>
            <small class="footerBottomTag">Built for digital rebels.</small>
        </div>
    </div>
</footer>
