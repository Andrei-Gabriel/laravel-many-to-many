@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">{{$category->name}}</h3>

                    <div class="card-body">
                        <div class="mb-2">
                            <h5 class="mb-4">Slug: {{$category->slugCat}}</h5>
                            @if (count($category->posts)) {{-- Non serve > 0 --}}
                                <h4>Lista posts associati: {{count($category->posts)}}</h4>
                                <ul>
                                    @foreach ($category->posts as $post)
                                        <li>
                                            {{$post->title}}
                                            @if ($post->published)
                                                <span class="badge badge-success ml-2 mb-2 py-1 px-2">Published</span>
                                            @else
                                                <span class="badge badge-warning ml-2 mb-2 py-1 px-2">Draft</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                
                            @else
                                <h4>Nessun post associato a questa categoria</h4>                             
                            @endif
                        </div>
                        <div class="container p-0 d-flex flex-row mt-3">
                            <a href="{{route("categories.edit", $category->id)}}"><button type="button" class="btn btn-warning mr-3">Modifica</button></a>
                            <form action="{{route("categories.destroy", $category->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <a href="{{route("categories.destroy", $category->id)}}"><button type="submit" class="btn btn-danger">Elimina</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection