<x-layout>
    <section class="categoryPage py-5">
        <div class="container">
            <div class="categoryHero text-center mb-5">
                <p class="articleIndexEyebrow mb-2">Categoria</p>
                <h1 class="heroTitle2 mb-3">
                    Articoli della categoria <span class="categoryName">{{ $category->name }}</span>
                </h1>
                <p class="articleIndexLead mx-auto mb-0">
                    Scopri i prodotti selezionati in questa categoria.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($articles as $article)
                    <div class="col-12 col-md-6 col-xl-4">
                        <x-card :article="$article" />
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="articleEmptyState py-5 px-4">
                            <h3 class="mb-3">Non sono ancora stati creati articoli per questa categoria.</h3>
                            @auth
                                <a class="btn btnCustom my-2" href="{{ route('create.article') }}">Pubblica un articolo</a>
                            @endauth
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- INIZIO BUTTON TORNA SU -->

    <a href="#" id="tornaSu"><i class="fa-solid fa-circle-chevron-up fa-3x" style="color: #ff008c;"></i></a>

    <!-- FINE BUTTON TORNA SU -->
</x-layout>
