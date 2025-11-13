<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $posts = Post::where("author_id", $user)->latest();

        if (request("keyword")) {
            $posts->where(function ($query) {
                $keyword = request("keyword");

                $query
                    ->where("title", "like", "%" . $keyword . "%")
                    ->orWhereHas("category", fn(Builder $query) => $query->where("name", "like", "%" . $keyword . "%"));
            });
        }

        return view("dashboard.index", ["posts" => $posts->paginate(10)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view("dashboard.create", compact("category"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // SIMPE VALIDATION
        // $request->validate([
        //     "title" => "required|unique:posts|min:4|max:50",
        //     "category" => "required",
        //     "body" => "required",
        // ]);

        // FULL VALIDATION
        Validator::make(
            $request->all(),
            [
                // Rules // TITLE HARUS UNIQUE KARENA MEMBUAT SLUG
                "title" => "required|unique:posts|min:4|max:250",
                "category" => "required",
                "body" => "required|min:120",
            ],
            [
                // Alert
                "title.required" => ":attribute must be filled",
                "category.required" => "Choose one :attribute",
                "body.min" => "The minimum content must be :min characters or more.",
            ],
            [
                // Attribute / nama Field
                "body" => "post",
            ],
        )->validate();

        Post::create([
            "title" => Str::title($request->title),
            "slug" => Str::slug($request->title),
            "author_id" => Auth::id(),
            "category_id" => $request->category,
            "body" => $request->body,
        ]);

        return redirect("/dashboard")->with(["success" => "Your post has been saved!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("dashboard.show", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        return view("dashboard.edit", compact("post", "category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // FULL VALIDATION
        Validator::make(
            $request->all(),
            [
                // Rules // TITLE TIDAK HARUS UNIQUE KARENA UPDATE
                "title" => "required|min:4|max:250|unique:posts,title," . $post->id,
                "category" => "required",
                "body" => "required|min:20",
            ],
            [
                // Alert
                "title.required" => ":attribute must be filled",
                "category.required" => "Choose one :attribute",
                "body.min" => "The minimum content must be :min characters or more.",
            ],
            [
                // Attribute / nama Field
                "body" => "post",
            ],
        )->validate();

        // Update Data
        $post->update([
            "title" => Str::title($request->title),
            "slug" => Str::slug($request->title),
            "author_id" => Auth::id(),
            "category_id" => $request->category,
            "body" => $request->body,
        ]);

        // Redirect
        return redirect()
            ->route("dashboard.show", ["post" => $post->slug])
            ->with(["success" => "Post has been updated!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect("/dashboard")->with(["success" => "Your post has been removed!"]);
    }
}
