<x-layout>
    <section class="articleIndexPage py-5">
        <div class="container">
            <div class="articleIndexHero text-center mb-5">
                <p class="articleIndexEyebrow mb-2">Marketplace</p>
                <h1 class="heroTitle2 mb-3">Tutti gli articoli</h1>
                <p class="articleIndexLead mx-auto mb-0">
                    Esplora gli ultimi annunci pubblicati dalla community cyber.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($articles as $article)
                    <div class="col-12 col-md-6 col-xl-4">
                        <x-card :article="$article" />
                    </div>
                @empty
                    <div class="col-12">
                        <div class="articleEmptyState text-center py-5 px-4">
                            <h3 class="mb-3">Non sono ancora stati creati articoli</h3>
                            @auth
                                <a class="btn btnCustom" href="{{ route('create.article') }}">Pubblica un articolo</a>
                            @endauth
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5 articlePaginationWrap">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
    <!-- INIZIO BUTTON TORNA SU -->

    <a href="#" id="tornaSu"><i class="fa-solid fa-circle-chevron-up fa-3x" style="color: #ff008c;"></i></a>

    <!-- FINE BUTTON TORNA SU -->
</x-layout>
