<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $request->validate($this->formAuthenticationRules());

        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->slugPostCheck($new_post->title);
        $new_post->save();
        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function formAuthenticationRules() {
        return [
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:5|max:60000'
        ];
    }

    protected function slugPostCheck($title) {

        // *saving in a variable the slugged version of the post title
        $slug_to_save = Str::slug($title, '-');

        // *saving the base version of the slugged title in a variable
        $base_slug = $slug_to_save;

        // *check if the slug already exists in the database
        $existing_slug = Post::where('slug', '=', $slug_to_save)->first();

        // *setting the while '$counter' to 1
        $counter = 1;

        // *start a while cycle untill '$existing_slug' is !== null
        while($existing_slug) {
            // *appending the '$counter' to '$slug_to_save'
            $slug_to_save = $base_slug . '-' . $counter;

            // *check if even the slug with the '$counter' appended exists in the database
            $existing_slug = Post::where('slug', '=', $slug_to_save)->first();

            // *if not we increment the '$counter' and we "restart" the while cycle
            $counter++;
        }

         // *when the '$existing_slug' is !== null we return '$slug_to_save'
        return $slug_to_save;
    }
}
