<x-layout>
    <section class="workWithUsPage py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="workWithUsHero text-center mb-5">
                        <p class="workWithUsEyebrow mb-2">Team Revisor</p>
                        <h1 class="titleCustom mb-3">Lavora con noi</h1>
                        <p class="workWithUsLead mx-auto mb-0">
                            Raccontaci la tua motivazione: il nostro team valuterà la tua candidatura per diventare
                            revisore.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="workWithUsPanel p-4 p-md-5">
                        @auth
                            <form action="{{ route('become.revisor') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="motivation" class="form-label createArticleLabel">Perche vuoi diventare
                                        revisore?</label>
                                    <textarea name="motivation" id="motivation" rows="7" class="form-control createArticleInput">{{ old('motivation') }}</textarea>
                                </div>

                                @error('motivation')
                                    <p class="createArticleError mb-3">{{ $message }}</p>
                                @enderror

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btnCustom px-4">Invia candidatura</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info text-center mb-0">
                                Devi effettuare l'accesso per inviare la candidatura.
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
