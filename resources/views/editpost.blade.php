@extends("layouts.app")

@section ("title")
    Редактирование
@endsection

@section ("content")
    <h3>Редактирование</h3>

    @if ($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>

        </div>
    @endif

  <div class="container" >

        @if (session('success'))

            <div class="alert alert-success">
                {{session('success')}}

            </div>
        @endif

        @if (!session('success'))
            <form action="{{ route('updatepost',$post->id) }}" method="post" enctype="multipart/form-data">


                @csrf
                <div class="form-group">
                    <label for="title">Название статьи</label>
                    <input type="text" name="title" placeholder="Название" value="{{$post->title}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Текст статьи</label>
                    <textarea  placeholder="Текст статьи" name="message"   class="form-control">{{$post->text}}</textarea>
                </div>

                <div>
                    <input type="checkbox" name="vision" value="1" checked>
                    <label for="vision">Статья видна всем</label>
                </div>

                <button type="submit" class="btn btn-warning navbar-inverse mt-3" >Отредактировать</button>
            </form>

        @endif

    </div>

@endsection
