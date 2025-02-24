<?php

namespace App\Http\Controllers\Admin\ActivityManagement;

use DataTables;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\ActivityImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.activity-management.blog.index');
    }

    public function blogLists()
    {
        $data = Blog::with('images')->orderBy('id', 'desc');

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->editColumn('image', function($each) {
                $path =count($each->images) > 0 ? $each->images[0] : null;

                $src = asset('storage').$path->image;

                $image = "<img src='$src' style='height: 50px; width: 50px; border-radius: 100%; object-fit: cover; border: 1px solid #333;'/>";

                return $image;
            })

            ->editColumn('content_eng', function($each) {
                $plainText = strip_tags($each->content);
                return mb_substr($plainText, 0, 200) . ' ...';
            })

            ->editColumn('content_mm', function($each) {
                $plainText = strip_tags($each->content);
                return mb_substr($plainText, 0, 200) . ' ...';
            })

            ->addColumn('action', function ($each) {

                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                $show_icon = '<a href="' . route('admin.blogs.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                // if (auth()->user()->can('photo_gallery_show')) {
                // }

                $edit_icon = '<a href="'.route('admin.blogs.edit', $each->id).'" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';

                $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['image', 'content', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activity-management.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $blog = new Blog();
            $blog->title_eng = $request->title_eng;
            $blog->title_mm = $request->title_mm;
            $blog->date = $request->date;
            $blog->content_eng = $request->content_eng;
            $blog->content_mm = $request->content_mm;
            $blog->save();

            if ($request->file('image')) {
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/images/activity_images', $fileName);
            }

            $activityImage = new ActivityImage();
            $activityImage->blog_id = $blog->id;
            $activityImage->image = $fileName ? '/images/activity_images/' . $fileName : null;
            $activityImage->save();

            DB::commit();
            session()->flash('success', 'Successfully Created !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog = $blog->load('images');
        return view('admin.activity-management.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.activity-management.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBlog(Request $request, Blog $blog)
    {
        DB::beginTransaction();

        try {
            $blog->title_eng = $request->title_eng;
            $blog->title_mm = $request->title_mm;
            $blog->date = $request->date;
            $blog->content_eng = $request->content_eng;
            $blog->content_mm = $request->content_mm;
            $blog->update();

            $fileName = null;
            if ($request->file('image')) {
                //delete old file
                File::delete(public_path('/storage' . $blog->images[0]->image));
                $blog->images()->delete();

                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/images/activity_images', $fileName);

                $activityImage = new ActivityImage();
                $activityImage->blog_id = $blog->id;
                $activityImage->image = $fileName ? '/images/activity_images/' . $fileName : null;
                $activityImage->save();
            }

            DB::commit();
            session()->flash('success', 'Successfully Updated !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        DB::beginTransaction();

        try {
            File::delete(public_path('/storage' . $blog->images[0]->image));
            $blog->images()->delete();
            $blog->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }
}
