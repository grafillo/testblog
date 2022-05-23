

<div class="row mb-0 mt-3 " ><h5><b><a href="{{route('getpost',$post->id)}}">{{$post->title}}</a></b></h5></div>


    <div class="row ">

    <div class="img-container mt-0 border " >

    </div>
        <div class="col mt-0">
        {{Str::limit($post->text,150, '...')}}

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

@if( isset(Auth::user()->role) && Auth::user()->role=="admin")
<form action="{{ route('changeavatar',$post->autor_id)}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
       <input type="file" name="image" >
</div>
<button type="submit" class="btn btn-primary navbar-inverse mt-3" >Сменить аватар</button>
</form>
@endif

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

