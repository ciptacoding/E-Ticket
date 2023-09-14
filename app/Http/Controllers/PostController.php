<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render(
            'Dashboard/Posts/Index', 
            [
                'posts' => Post::query()
                ->when($request->input('search'), function($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('excerpt', 'like', '%'.$search.'%')
                    ->orWhere('body', 'like', '%'.$search.'%');
                })->orderByDESC('date_post')->paginate(10)->withQueryString(),
                'filters' => $request->only(['search'])
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
			'title' => 'required|min:20|max:165',
			'image' => 'image|file|max:2048|mimes:png,jpg,jpeg',
			'excerpt' => 'required|max:165|min:20',
			'date_post' => 'required|date',
			'body' => 'required|min:50'
		]);

        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images');
        }

        Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'image' => $image_path,
            'excerpt' => $request->excerpt,
            'date_post' => $request->date_post,
            'body' => $request->body
        ]);
 
		return redirect()->route('posts.index')->with('message', 'Post Has Been Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Dashboard/Posts/Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Dashboard/Posts/Edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updates(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'title' => 'required|min:20|max:165',
			'excerpt' => 'required|max:165|min:20',
			'date_post' => 'required|date',
			'body' => 'required|min:50'
        ]);

		$post = Post::findOrFail($id);
		
		//check if image is uploaded
		if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|file|max:2048|mimes:png,jpg,jpeg',
            ]);

			//upload gambar baru
			$image_path = $request->file('image')->store('images');
			
			//hapus gambar lama
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }

			//update data ke database
			$post->update([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'date_post' => $request->date_post,
                'image' => $image_path,
                'body' => $request->body,
            ]);
		} else {
			//jika tidak ada image baru di upload
			$post->update([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'date_post' => $request->date_post,
                'image' => $request->image,
                'body' => $request->body,
            ]);

		}

		return redirect()->route('posts.index')->with('message', 'Post Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

		if($post->image) {
			Storage::delete($post->image);
		}

		$post->delete();
		return redirect()->route('posts.index')->with('success', 'Post Has Been Deleted!');
    }
}
