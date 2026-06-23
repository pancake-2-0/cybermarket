<x-layout>

    <div class="container-fluid pt-5 revisor-page">
        @if (session()->has('message'))
            <div class="row justify-content-center">
                <div
                    class="col-12 col-lg-6 alert alert-success alert-dismissible fade show text-center shadow rounded position-relative pe-5">
                    <span class="d-block text-center">{{ session('message') }}</span>
                    <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-3"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-xl-10">
                <div class="revisor-hero">
                    <div>
                        <p class="revisor-eyebrow mb-2">Area di revisione</p>
                        <h1 class="revisor-title mb-0">Revisor Dashboard</h1>
                    </div>
                    <div class="revisor-counter">
                        <span class="revisor-counter-label">Da revisionare</span>
                        <span class="revisor-counter-value">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                    </div>
                </div>
            </div>
        </div>


        @if ($article_to_check)
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="revisor-panel">
                        <div class="row g-4 align-items-stretch">
                            <div class="col-12 col-lg-5">
                                <div class="revisor-carousel-wrap">
                                    <div id="carouselExample" class="carousel slide">
                                        @if ($article_to_check->images->count())
                                            <div class="carousel-inner">
                                                @foreach ($article_to_check->images as $key => $image)
                                                    <div
                                                        class="carousel-item @if ($loop->first) active @endif">
                                                        <img src="{{ $image->getUrl(600, 600) }}"
                                                            class="d-block w-100 rounded shadow"
                                                            alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('media/logo1.png') }}" alt="immagine segnaposto"
                                                        class="d-block w-100 rounded shadow">
                                                </div>
                                            </div>
                                        @endif

                                        @if ($article_to_check->images->count() > 1)
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-7">
                                <div class="revisor-content h-100">
                                    @php
                                        $analysisImage = $article_to_check->images->first();
                                        $safeSearchRatings = [
                                            'adult' => $analysisImage?->adult,
                                            'violence' => $analysisImage?->violence,
                                            'spoof' => $analysisImage?->spoof,
                                            'racy' => $analysisImage?->racy,
                                            'medical' => $analysisImage?->medical,
                                        ];
                                    @endphp

                                    <div>
                                        <span class="revisor-category">#{{ $article_to_check->category->name }}</span>
                                        <h2 class="revisor-article-title mt-3">{{ $article_to_check->title }}</h2>
                                        <p class="revisor-meta mb-2">Autore: {{ $article_to_check->user->name }}</p>
                                        <p class="revisor-price mb-4">{{ $article_to_check->price }} &euro;</p>
                                        <p class="revisor-description mb-0">{{ $article_to_check->description }}</p>
                                    </div>

                                    <div class="row g-3 mt-1">
                                        <div class="col-12 col-xl-6">
                                            <div class="card revisor-analysis-card h-100">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h5 class="mb-0">Labels</h5>

                                                    </div>

                                                    @if ($analysisImage && !empty($analysisImage->labels))
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach ($analysisImage->labels as $label)
                                                                <span
                                                                    class="badge rounded-pill revisor-label-pill px-3 py-2">
                                                                    #{{ $label }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @elseif($analysisImage)
                                                        <p class="fst-italic revisor-analysis-copy mb-0">Nessuna label
                                                            disponibile
                                                            per questa immagine.</p>
                                                    @else
                                                        <p class="fst-italic revisor-analysis-copy mb-0">Carica almeno
                                                            un'immagine
                                                            per visualizzare le label automatiche.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6">
                                            <div class="card revisor-analysis-card h-100">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h5 class="mb-0">Safe Search</h5>
                                                        <span class="badge revisor-analysis-badge">Controllo
                                                            contenuti</span>
                                                    </div>

                                                    @if ($analysisImage)
                                                        <div class="d-flex flex-column gap-2">
                                                            @foreach ($safeSearchRatings as $label => $value)
                                                                @php
                                                                    $statusLabel = 'N/D';

                                                                    if (
                                                                        str_contains(
                                                                            (string) $value,
                                                                            'bi-check-circle-fill',
                                                                        )
                                                                    ) {
                                                                        $statusLabel = 'Basso';
                                                                    } elseif (
                                                                        str_contains(
                                                                            (string) $value,
                                                                            'bi-exclamation-circle-fill',
                                                                        )
                                                                    ) {
                                                                        $statusLabel = 'Medio';
                                                                    } elseif (
                                                                        str_contains(
                                                                            (string) $value,
                                                                            'bi-dash-circle-fill',
                                                                        )
                                                                    ) {
                                                                        $statusLabel = 'Alto';
                                                                    } elseif (
                                                                        str_contains((string) $value, 'bi-circle-fill')
                                                                    ) {
                                                                        $statusLabel = 'Non disponibile';
                                                                    }
                                                                @endphp

                                                                <div
                                                                    class="revisor-rating-row d-flex justify-content-between align-items-center rounded-3 px-3 py-2">
                                                                    <span
                                                                        class="text-capitalize fw-semibold">{{ $label }}</span>
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        @if ($value)
                                                                            <i class="{{ $value }}"></i>
                                                                        @endif
                                                                        <span
                                                                            class="small fw-semibold">{{ $statusLabel }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="fst-italic revisor-analysis-copy mb-0">Nessuna
                                                            immagine
                                                            disponibile per l'analisi Safe Search.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="revisor-actions">
                                            <form action="{{ route('reject', ['article' => $article_to_check]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn revisor-btn revisor-btn-reject">Rifiuta</button>
                                            </form>

                                            <form action="{{ route('accept', ['article' => $article_to_check]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn revisor-btn revisor-btn-accept">Accetta</button>
                                            </form>
                                        </div>

                                        @if ($last_reviewed_article)
                                            <div class="revisor-restore">
                                                <form
                                                    action="{{ route('restore', ['article' => $last_reviewed_article]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn revisor-btn revisor-btn-restore">
                                                        Ripristina ultimo articolo revisionato
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center align-items-center height-custom text-center">
                    <div class="col-12 col-xl-10">
                        <div class="revisor-empty-state">
                            <p class="revisor-eyebrow mb-3">Area di revisione</p>
                            <h1 class="fst-italic display-4 mb-3">
                                Nessun articolo da revisionare
                            </h1>
                            <p class="revisor-empty-copy">
                                La coda e vuota al momento. Quando arriveranno nuovi articoli, li troverai qui.
                            </p>

                            @if ($last_reviewed_article)
                                <form action="{{ route('restore', ['article' => $last_reviewed_article]) }}"
                                    method="POST" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn revisor-btn revisor-btn-restore">Ripristina ultimo articolo
                                        revisionato</button>
                                </form>
                            @endif

                            <a href="{{ route('home') }}" class="mt-4 btn revisor-btn revisor-btn-home">Torna
                                all'homepage</a>
                        </div>
                    </div>
                </div>
        @endif
    </div>
</x-layout>
