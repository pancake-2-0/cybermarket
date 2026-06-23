<x-layout>
    <div class="authPage">
        <div class="authCard">
            <h1 class="authTitle">Accedi</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="authFormGroup">
                    <label class="authLabel" for="username">Nome utente</label>

                    <input class="authInput" type="text" name="username" value="{{ old('username') }}">
                </div>

                <div class="authFormGroup">
                    <label class="authLabel">Email</label>
                    <input class="authInput" type="email" name="email" value="{{ old('email') }} ">
                    @error('email')
                        <p class="text-danger authError">{{ $message }}</p>
                    @enderror
                </div>

                <div class="authFormGroup">
                    <label class="authLabel">Password</label>
                    <input class="authInput" type="password" name="password">
                    @error('password')
                        <p class="text-danger authError">{{ $message }}</p>
                    @enderror
                </div>

                <button class="authButton" type="submit">Accedi</button>

                <p class="authSwitch">
                    <a href="{{ route('register') }}">Non hai un account? Registrati</a>
                </p>
            </form>
        </div>
    </div>
</x-layout>
