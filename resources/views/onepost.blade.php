@extends("layouts.app")

@section ("title")
    Галерея
@endsection

@section ("content")



        <div class="row mb-0 mt-3 " ><h4>{{$post->title}}</h4></div>


        <div class="row ">

            <div class="col mt-0">

                {{$post->text}}
            </div>
        </div>

        <div class="text-right"><span class="small-text">Автор:{{$post->autor}}</span></div>
        <div class="text-right">
            <img src="@if($post->getAvatar->avatar == 'user')
            {{asset('/storage/').'/'."none.jpg"}}
            @else
            {{asset('/storage/').'/'.$post->getAvatar->avatar}}
            @endif
                " class="img-responsive"  width="75" >

        </div>

        @can('update',$post)

            <form action="{{ route('updatevision',$post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="checkbox" name="vision" value="1" @if($post->vision == 1){{'checked'}}@endif>
                    <label for="vision">Статья видна всем</label>
                </div>
                <button type="submit" class="btn btn-primary navbar-inverse mt-3" >Сохранить</button>
            </form>

            <div class="mt-1">
                <a type="button" class="btn btn-warning"    href="{{ route("editpost", $post->id) }}">Редактировать</a>
                <a type="button" class="btn btn-danger"    href="{{ route("deletepost", $post->id) }}">Удалить</a>
            </div>
        @endcan


@endsection


