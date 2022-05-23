@extends("layouts.app")

@section ("title")
   Галерея
@endsection

@section ("content")


    <div class="text-left text-success">
        <h5>Все статьи!!</h5>
    </div>

    @if (session('success'))

        <div class="alert alert-success">
            {{session('success')}}

        </div>
    @endif


        @foreach ($posts as $post)
            @include('inc.post')
        @endforeach

    <div class="d-flex justify-content-center">


    </div>

@endsection

