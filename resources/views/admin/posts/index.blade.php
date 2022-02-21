@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{route("posts.create")}}"><button type="button" class="btn btn-success">Aggiungi un post</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Stato</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tags</th>
                <th scope="col">Actions</th>
                {{-- Altrimenti i bordi fanno schifo --}}
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    @if ($post->published)
                        <td><span class="badge badge-success py-1 px-2">Published</span></td>
                    @else
                        <td><span class="badge badge-secondary py-1 px-2">Draft</span></td>
                    @endif
                    @if ($post->category)
                        <td><span class="badge badge-primary py-1 px-2">{{$post->category->name}}</span></td>
                    @else
                        <td><span class="badge badge-warning py-1 px-2">Nessuna categoria</span></td>
                    @endif
                    @if (count($post->tags))
                        <td>
                            <ul class="list-unstyled">
                                @foreach ($post->tags as $tag)
                                    <li><span class="badge badge-primary py-1 px-2">{{$tag->name}}</span></li>
                                @endforeach
                            </ul>
                        </td>
                    @else
                        <td><span class="badge badge-warning py-1 px-2">No Tag</span></td>
                    @endif
                    <td>
                        <a href="{{route("posts.show", $post->id)}}"><button type="button" class="btn btn-primary">Più info</button></a>
                    </td>
                    <td>
                        <a href="{{route("posts.edit", $post->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                    </td>
                    <td>
                        <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <a href="{{route("posts.destroy", $post->id)}}"><button type="submit" class="btn btn-danger">Elimina</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection