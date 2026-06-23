<div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show createArticleAlert mb-4 position-relative pe-5">
            <span class="d-block text-center">{{ session('success') }}</span>
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-3"
                data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form class="createArticleForm p-5 p-md-5" wire:submit="store">
        <div class="mb-3">
            <label for="title" class="form-label createArticleLabel">Titolo</label>
            <input type="text" class="form-control createArticleInput @error('title') is-invalid @enderror"
                id="title" wire:model.live="title">
            @error('title')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label createArticleLabel">Descrizione</label>
            <textarea id="description" cols="30" rows="8"
                class="form-control createArticleInput @error('description') is-invalid @enderror" wire:model.live="description"></textarea>
            @error('description')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label createArticleLabel">Prezzo</label>
            <input type="text" class="form-control createArticleInput @error('price') is-invalid @enderror"
                id="price" wire:model.live="price">
            @error('price')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="temporary_images" class="form-label createArticleLabel">Immagini</label>
            <input type="file" wire:model.live="temporary_images" multiple id="temporary_images"
                class="form-control createArticleInput @error('temporary_images.*') is-invalid @enderror"
                placeholder="Img/" />
            @error('temporary_images.*')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
            @error('temporary_images')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
        </div>

        @if (!empty($images))
            <div class="row mt-4">
                <div class="col-12">
                    <p class="createArticleLabel mb-3">Anteprima immagini</p>
                    <div class="row g-3 createArticlePreviewWrap py-3 px-2 px-md-3">
                        @foreach ($images as $key => $image)
                            <div class="col-6 col-md-4 col-lg-3 d-flex flex-column align-items-center">
                                <div class="img-preview createArticlePreview mx-auto"
                                    style="background-image: url({{ $image->temporaryUrl() }});">
                                </div>
                                <button type="button" class="btn createArticleRemoveBtn mt-2"
                                    wire:click="removeImage({{ $key }})">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        <div class="mb-3">
            <select id="category" wire:model.live="category"
                class="form-control createArticleInput @error('category') is-invalid @enderror">
                <option value="" disabled> Seleziona una categoria </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="createArticleError mt-2 mb-0">{{ $message }}</p>
            @enderror
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btnCustom px-4">Pubblica</button>
        </div>
    </form>
</div>
