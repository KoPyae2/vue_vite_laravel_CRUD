<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index',['posts'=>$posts]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store()
    {
        $formData = request()->validate([
            'title'=>'required | min:10',
            'body'=>'required | min:10'
        ]);

        Post::create($formData);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    public function update($id, Request $request)
    {
        $formData= request()->validate([
            'title' => 'required | min:10',
            'body' => 'required | min:10'
        ]);
        Post::find($id)->update($formData);
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }
}