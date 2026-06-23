<x-layout>
    <div class="authPage">
        <div class="authCard">
            <h1 class="authTitle">Registrati</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="authFormGroup">
                    <label class="authLabel">Nome utente</label>
                    <input class="authInput" type="text" name="name" value="{{ old('name') }}">

                    @error('name')
                        <p class="text-danger authError">{{ $message }}</p>
                    @enderror
                </div>
                <div class="authFormGroup">
                    <label class="authLabel">Email</label>
                    <input class="authInput" type="email" name="email" value="{{ old('email') }}">
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

                <div class="authFormGroup">
                    <label class="authLabel">Conferma Password</label>
                    <input class="authInput" type="password" name="password_confirmation">
                </div>

                <button class="authButton" type="submit">Registrati</button>
            </form>
            <p class="authSwitch">
                <a href="{{ route('login') }}">Hai già un account? Accedi</a>
            </p>
        </div>
    </div>
</x-layout>
