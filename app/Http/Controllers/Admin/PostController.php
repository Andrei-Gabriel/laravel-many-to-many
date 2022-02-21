<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Creato array associativo con le regole di validazione per non avere del codice ripetuto
    protected $ValidationsRules = [
        "title" => "required|string|max:100",
        "content" => "required",
        "published" => "sometimes|accepted",
        "category_id" => "nullable|exists:categories,id",
        // Unable to guess the MIME type as no guessers are available (have you enabled the php_fileinfo extension?).
        // "image" => "nullable|image|mime:jpeg,jpg,bmp,png|max:2048"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dei dati
        $request->validate($this->ValidationsRules);
    
        // $request->validate([
        //     "title" => "required|string|max:100",
        //     "content" => "required",
        //     "published" => "sometimes|accepted",
        // ]);

        // Creazione del post
        $data = $request->all();
        
        $newPost = new Post();
        $newPost->title = $data["title"];
        $newPost->content = $data["content"];
        $newPost->published = isset($data["published"]) ? 1 : 0;
        $newPost->category_id = $data["category_id"];

        $slug = Str::of($newPost->title)->slug("-");
        $count = 1;

        while(Post::where("slug", $slug)->first()){
            $slug = Str::of($newPost->title)->slug("-")."-$count";
            $count++;
        }

        $newPost->slug = $slug;
        $newPost->save();

        // Se presente, salvo img
        if (isset($data["image"])) {
            $path_image = Storage::put("uploads", $data["image"]);
            $newPost->image = $path_image;
        }

        // Redirect al post appena creato
        return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view("admin.posts.edit", compact("post", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validazione dei dati
        $request->validate($this->ValidationsRules);
        // $request->validate([
        //     "title" => "required|string|max:100",
        //     "content" => "required",
        //     "published" => "sometimes|accepted",
        // ]);

        // Aggiorno il post
        $data = $request->all();

        // se cambia il titolo aggiorno lo slug
        if ($post->title != $data["title"]) {
            $post->title = $data["title"];
            $slug = Str::of($post->title)->slug("-");
            // Se lo slug generato è diverso dallo slug attualmente salvato nel db
            if($slug != $post->slug) {
                $count = 1;
                while(Post::where("slug", $slug)->first()){
                    $slug = Str::of($post->title)->slug("-")."-$count";
                    $count++;
                }
                $post->slug = $slug;
            }
        }  
        $post->content = $data["content"];
        $post->category_id = $data["category_id"];


        // if(isset($data["published"])) {
        //     $post->published = true;
        // } else {
        //     $post->published = false;
        // }
        $post->published = isset($data["published"]);
  
        $post->save();

        // Redirect al post modificato
        return redirect()->route("posts.show", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("posts.index");
    }
}
