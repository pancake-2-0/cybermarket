<x-layout>
    <section class="createArticlePage py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9">
                    <div class="createArticleHero text-center mb-5">
                        <p class="createArticleEyebrow mb-2">Nuovo annuncio</p>
                        <h1 class="titleCustom display-4 mb-3">Pubblica un articolo</h1>
                        <p class="createArticleLead mx-auto mb-0">
                            Compila i campi e carica le immagini per condividere il tuo prodotto con la community.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-xl-9">
                    <livewire:create-article-form />
                </div>
            </div>
        </div>
    </section>
</x-layout>
