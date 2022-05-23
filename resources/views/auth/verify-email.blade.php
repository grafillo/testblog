<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Благодарим за регистрацию! Но прежде чем начать вы должны подтвердить вашу учётную запись перейдя по ссылке в письме, посланном на ваш электронный адрес. Иначе некоторые функции будут недоступны.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Новое письмо с верификацией было послано на ваш почтовый ящик уазанный во время регистрации.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Отослать заново письмо верификации') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Выход') }}
                </button>
            </form>

            <form method="POST" action="{{ route('index') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('На главную') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
