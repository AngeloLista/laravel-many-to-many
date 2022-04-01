<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use App\Mail\PublishedPostMail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::paginate(10);

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $post = new Post();
        $tags = Tag::all();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts|max:50',
            'content' => 'required|string',
            // 'image' => 'nullable|url|max:255',   Image Url Validation
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $data['user_id'] = Auth::id();

        // Image file
        if (array_key_exists('image', $data)) $data['image'] = Storage::put('post_images', $data['image']);

        $post = Post::create($data);

        // Tags link relation
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        // Sending notification mail
        $mail = new PublishedPostMail();
        $recipient = Auth::user()->email;
        Mail::to($recipient)->send($mail);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
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
        $tags = Tag::all();

        // Tag Checkboxes
        $post_tags_ids = $post->tags->pluck('id')->toArray(); //id dei tags relazionati col il post specifico

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tags_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'max:50'],
            'content' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        // Image file
        if (array_key_exists('image', $data)) {
            if ($post->image) Storage::delete($post->image);
            $data['image'] = Storage::put('post_images', $data['image']);
        }

        $post->update($data);

        // Tags Checkboxes
        if (!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Prima elimino eventuli relazioni:
        if (count($post->tags)) $post->tags()->detach();
        // Poi elimino eventuali file contenuti nel post:
        if ($post->image) Storage::delete($post->image);
        // Poi elimino il post:
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "$post->title has been successfully deleted")->with('type', 'success');
    }
}
