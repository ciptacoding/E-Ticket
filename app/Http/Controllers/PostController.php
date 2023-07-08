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
                })->orderByDESC('date_post')->paginate(6)->withQueryString(),
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
			'title' => 'required|min:10|max:255',
			'image' => 'image|file|max:2048|mimes:png,jpg,jpeg',
			'excerpt' => 'required|max:255|min:10',
			'date_post' => 'required|date',
			'body' => 'required|min:20'
		]);

        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images');
        }

        Post::create([
            'title' => $request->title,
            'image' => $image_path,
            'excerpt' => $request->excerpt,
            'date_post' => $request->date_post,
            'body' => $request->body
        ]);
 
		return redirect()->route('posts.index')->with('success', 'Post Has Been Created!');
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
    public function update(Request $request, string $id)
    {
        //validate form
        $validated = $request->validate([
            'title' => 'required|min:10|max:255',
			'excerpt' => 'required|max:255|min:10',
			'date_post' => 'required|date',
			'body' => 'required|min:20'
        ]);

		$post = Post::findOrFail($id);
		
		//check if image is uploaded
		if ($request->hasFile('image')) {
            
			//upload gambar baru
			$image = $request->file('image');
			$image->store('images');
			
			//hapus gambar lama
            Storage::delete($post->image);

			//update data ke database
			$post->update([
				'title'     => $request->title,
				'image'     => $image->hashName(),
				'excerpt'   => $request->excerpt,
				'date_post' => $request->date_post,
				'body' => strip_tags($request->body),
		  	]);
		} else {
			//jika tidak ada image baru di upload
			$post->update([
				'title'     => $request->title,
				'excerpt'   => $request->excerpt,
				'date_post' => $request->date_post,
				'body' => strip_tags($request->body),
		  	]);

		}
		return redirect()->route('posts.index')->with('success', 'Post Has Been Updated!');
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
