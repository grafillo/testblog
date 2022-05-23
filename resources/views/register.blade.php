@extends("layouts.app")

@section ("title")
    Регистрация
@endsection

@section ("content")

    <div class="col text-center">


        @if(count($errors))
            <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
            </div>
        @endif

        <h4>Регистрация</h4>
    <form method="POST" action="{{ route('register') }}">
    @csrf
    <!-- Name -->
        <label for="name" >Имя</label>
        <div class="mb-1">
            <input id="name" class="input-group-sm" type="text" name="name" value="{{old('name')}}" required autofocus />
        </div>
        <!-- Email Address -->
        <label for="login" > Email или телефон</label>
        <div class="mb-1">
           <input id="login" class="input-group-sm"  name="login" value="{{old('login')}}"  />
        </div>
        <!-- Password -->
        <label for="password" >Пароль</label>
        <div class="mb-1">
            <input id="password" class="input-group-sm"
                     type="password"
                     name="password"
                     required autocomplete="new-password" />
        </div>
        <!-- Confirm Password -->
        <label class="">Повторите пароль</label>
        <div class="mb-1">

            <input id="password_confirmation" class="input-group-sm"
                     type="password"
                     name="password_confirmation" required />
        </div>
        <div class="mb-1">
            <button class="btn btn-success">
                {{ __('Register') }}
            </button>
        </div>
            <div>
            <a class="" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>

    </div>

@endsection
