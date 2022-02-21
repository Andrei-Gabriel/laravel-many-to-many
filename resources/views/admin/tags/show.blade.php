@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">{{$tag->name}}</h3>

                    <div class="card-body">
                        <div class="mb-2">
                            <h5 class="mb-4">Slug: {{$tag->slug}}</h5>
                            @if (count($tag->posts)) {{-- Non serve > 0 --}}
                                <h4>Lista posts associati: {{count($tag->posts)}}</h4>
                                <ul>
                                    @foreach ($tag->posts as $post)
                                        <li>
                                            {{$post->title}}
                                            @if ($post->published)
                                                <span class="badge badge-success ml-2 mb-2 py-1 px-2">Published</span>
                                                @if ($post->category)
                                                    <span class="badge badge-primary py-1 px-2">{{$post->category->name}}</span>
                                                @else
                                                    <span class="badge badge-warning py-1 px-2">Nessuna categoria</span>
                                                @endif
                                            @else
                                                <span class="badge badge-warning ml-2 mb-2 py-1 px-2">Draft</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>Nessun post associato a questo tag</h4>                             
                            @endif
                        </div>
                        <div class="container p-0 d-flex flex-row mt-3">
                            <a href="{{route("tags.edit", $tag->id)}}"><button type="button" class="btn btn-warning mr-3">Modifica</button></a>
                            <form action="{{route("tags.destroy", $tag->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <a href="{{route("tags.destroy", $tag->id)}}"><button type="submit" class="btn btn-danger">Elimina</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection