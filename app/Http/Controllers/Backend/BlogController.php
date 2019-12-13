<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    protected $limit = 5;
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($status = $request->get('status')) && $status == 'trash') 
        {
            $posts = Post::onlyTrashed()->with('category', 'author')->latest()->paginate($this->limit);
            $postCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        } else 
        {
            $posts = Post::with('category', 'author')->latest()->paginate($this->limit);
            $postCount = Post::count();
            $onlyTrashed = false;
        }

        return view('backend.blog.index', compact('posts', 'postCount', 'onlyTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);

        return redirect('/backend/blog/')->with('message', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view("backend.blog.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $oldImage = $post->image;
        $data = $this->handleRequest($request);

        if($oldImage !== $post->image)
        {
            $this->removeImage($oldImage);
        }

        $post->update($data);

        return redirect('/backend/blog/')->with('message', 'Post updated successfully!');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect('/backend/blog')->with('trash-message', ['Post has been moved to trash!', $id]);
    }

    /**
     * Remove the specified resource permanently from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image);

        return redirect('/backend/blog?status=trash')->with('message', 'Post has been deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('/backend/blog')->with('message', 'Post has been restored from trash!');
    }

    private function removeImage($image)
    {
        if(!empty($image))
        {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumbnail.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if(file_exists($imagePath)) unlink($imagePath);
            if(file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUpload = $image->move($destination, $fileName);

            if ($successUpload) {
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumbnail.{$extension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }

        return $data;
    }
}
