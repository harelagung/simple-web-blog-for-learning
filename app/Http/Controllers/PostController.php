<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function explore()
    {
        $posts = Post::latest()
            ->filter(request(["search", "category", "author"]))
            ->paginate(9)
            ->withQueryString();

        return view("posts", ["title" => "Blog", "header" => "Blog Page", "posts" => $posts]);
    }

    public function post(Post $post)
    {
        $header = $post["title"];

        return view("post", ["title" => "Single Post", "header" => "Single Post", "post" => $post]);
    }
}
