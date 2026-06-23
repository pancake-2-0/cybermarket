<x-layout>
    <section class="articleIndexPage py-5">
        <div class="container">
            <div class="articleIndexHero text-center mb-5">
                <p class="articleIndexEyebrow mb-2">Dettaglio annuncio</p>
                <h1 class="heroTitle2 mb-3">{{ $article->title }}</h1>
                <p class="articleIndexLead mx-auto mb-0">
                    Pubblicato da <span class="neonCyan">{{ optional($article->user)->name ?? 'Utente' }}</span>
                    @if ($article->created_at)
                        &middot; {{ $article->created_at->format('d/m/Y') }}
                    @endif
                </p>

                <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                    <a class="btn btn-outline-info btn-cyber" href="{{ route('article.index') }}">
                        Tutti gli articoli
                    </a>
                    <a class="btn btn-outline-info btn-cyber text-capitalize"
                        href="{{ route('byCategory', ['category' => $article->category]) }}">
                        {{ $article->category->name }}
                    </a>
                </div>
            </div>

            <div class="row g-4 align-items-start">
                <div class="col-12 col-lg-6">
                    <div class="createArticleForm p-3 p-md-4">
                        @if ($article->images->isNotEmpty())
                            <div id="articleImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded-4 overflow-hidden">
                                    @foreach ($article->images as $key => $image)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="{{ $image->getUrl() }}" class="d-block w-100"
                                                alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}">
                                        </div>
                                    @endforeach
                                </div>

                                @if ($article->images->count() > 1)
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#articleImagesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#articleImagesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="ratio ratio-1x1 rounded-4 overflow-hidden">
                                <img src="{{ asset('media/logo1.png') }}" alt="Nessuna foto inserita dall'utente">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="createArticleForm p-4 p-md-5">
                        <div class="d-flex flex-column gap-4">
                            <div>
                                <p class="createArticleLabel mb-2">Prezzo</p>
                                <p class="fs-2 fw-bold mb-0">
                                    {{ number_format((float) $article->price, 2, ',', '.') }} &euro;
                                </p>
                            </div>

                            <div>
                                <p class="createArticleLabel mb-2">Categoria</p>
                                <a class="btn btn-outline-info btn-cyber text-capitalize"
                                    href="{{ route('byCategory', ['category' => $article->category]) }}">
                                    {{ $article->category->name }}
                                </a>
                            </div>

                            <div>
                                <p class="createArticleLabel mb-2">Descrizione</p>
                                <p class="mb-0" style="white-space: pre-line;">
                                    {{ $article->description }}
                                </p>
                            </div>

                            <div>
                                @auth
                                    @if ($article->user && Auth::id() == $article->user->id)
                                        <div class="d-flex gap-2">
                                            {{-- Form Eliminazione --}}
                                            <form action="{{ route('article.destroy', $article) }}" method="POST"
                                                onsubmit="return confirm('Sei sicuro di voler eliminare questo articolo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-destroy">Elimina
                                                    Articolo</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
