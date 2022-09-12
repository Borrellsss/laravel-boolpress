<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $confirm_deleted_post = $request->all();

        $posts = Post::all();
        // dd(is_array($posts->item));

        $date_format = $this->getTimeSpanCalculator($posts, 'updated_at', 'second');

        $data = [
            'posts' => $posts,
            'confirm_deleted_post' => $confirm_deleted_post,
            'date_format' => $date_format
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
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->formAuthenticationRules());

        
        $form_data = $request->all();
        
        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->slugPostCheck($new_post->title);
        $new_post->save();

        if(isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }

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

        $date_format = $this->getTimeSpanCalculator($post, 'updated_at', 'hour');

        return view('admin.posts.show', compact('post', 'date_format'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        $request->validate($this->formAuthenticationRules());

        $form_data = $request->all();

        $post_to_update = Post::findOrFail($id);
        
        if($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->slugPostCheck($form_data['title']);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->update($form_data);

        if(isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', $post_to_update->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        $post_deleted = 'y';

        return redirect()->route('admin.posts.index', compact('post_deleted'));
    }

    protected function formAuthenticationRules() {
        return [
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:5|max:60000',
            'category_id' => 'nullable|exists:App\Category,id',
            'tags' => 'nullable|exists:App\Tag,id'
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

    protected function getTimeSpanCalculator($first_arg, $second_arg, $third_arg) {
        $today_date = Carbon::now();
        $column_date_to_compare = $second_arg;
        $diff_function_name = 'diffIn' . ucfirst($third_arg) . 's';

        if($first_arg instanceof Collection) {
            foreach($first_arg as $first_arg_item) {
                $first_arg_item['time_span'] = $first_arg_item->$column_date_to_compare->$diff_function_name($today_date);
            }

        } else {
            $first_arg->time_span = $first_arg->$column_date_to_compare->$diff_function_name($today_date);
        }

        return $third_arg;
    }
}