<div class="card card-cyber mx-auto mb-3">

    <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(600, 600) : asset('media/logo1.png') }}"
        class="card-img-top" alt="Immagine dell'articolo {{ $article->title }}" height="400">

    <div class="card-body text-start">
        <h4 class="card-title-cyber">{{ $article->title }}</h4>
        <p class="card-category-cyber text-muted small">{{ $article->category->name }}</p>

        <span class="card-price-cyber me-3">
            <strong>{{ $article->price }}</strong> <span>€</span>
        </span>

        <div class="d-flex justify-content-between align-items-center mt-4">


            <div class="d-flex gap-2">
                <a href="{{ route('article.show', compact('article')) }}" class="btn btn-outline-info btn-cyber">
                    DETTAGLI
                </a>
                <a href="{{ route('byCategory', ['category' => $article->category]) }}"
                    class="btn btn-outline-info btn-cyber">
                    {{ $article->category->name }}
                </a>
            </div>

        </div>
    </div>
</div>
