<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="number" name="cpf" :value="old('cpf')" required autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" required autocomplete="data_nascimneto" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Número de Telefone com DDD')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="number" name="telefone" :value="old('telefone')" required autocomplete="telefone" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Gênero -->
        <div class="mt-4">
            <x-input-label for="genero" :value="__('Seu Gênero')" />
            <select id="genero" class="block mt-1 w-full" type="number" name="genero" :value="old('genero')" required autocomplete="Genero">
                <option value="">Selecione o gênero</option>
                @foreach (App\Models\Usuario::generos() as $genero)
                    <option value="{{ $genero }}" {{ old('genero') == $genero ? 'selected' : '' }}>
                        {{ $genero }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="senha" :value="__('Senha')" />

            <x-text-input id="senha" class="block mt-1 w-full"
                            type="password"
                            name="senha"
                            required autocomplete="new-senha" />

            <x-input-error :messages="$errors->get('senha')" class="mt-2" />
        </div>

        <!-- Confirmação de Senha-->
        <div class="mt-4">
            <x-input-label for="confirmacao_senha" :value="__('Confirme sua Senha')" />

            <x-text-input id="confirmacao_senha" class="block mt-1 w-full"
                            type="password"
                            name="senha_confirmation"
                            required autocomplete="new-senha" />

            <x-input-error :messages="$errors->get('confirmacao_senha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já possui uma conta? Clique aqui!') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
