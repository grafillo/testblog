@extends("layouts.app")

@section ("title")
    Добавить статью
@endsection

@section ("content")
    <h3>Создать новую статью</h3>

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
            <form action="{{ route('addpost') }}" method="post" enctype="multipart/form-data">

                 @csrf
                <div class="form-group">
                    <label for="title">Введите название</label>
                    <input type="text" name="title" placeholder="Название" value="{{old('title')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Текст статьи</label>
                    <textarea  placeholder="Текст статьи" name="message"  class="form-control">{{old('message')}}</textarea>
                </div>

                <div>
                    <input type="checkbox" name="vision" value="1" checked>
                    <label for="vision">Статья видна всем</label>
                </div>


                <button type="submit" class="btn btn-primary navbar-inverse mt-3" >Опубликовать</button>
            </form>

        @endif

    </div>

@endsection
