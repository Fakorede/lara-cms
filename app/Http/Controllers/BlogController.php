<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit = 5;

    public function index()
    {
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();
        // \DB::enableQueryLog();
        $posts = Post::with('author')
                ->latestFirst()
                ->published()
                ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categories'));
        // dd(\DB::getQueryLog());
    }

    /**
     * Display a listing of cateogires.
     *
     * @return \Illuminate\Http\Response
     */

    public function categories($id)
    {
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        $posts = Post::with('author')
                ->latestFirst()
                ->published()
                ->where('category_id', $id)
                ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);
        return view("blog.show", compact('post'));
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
}
