<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;

class SuccessStoryController extends Controller
{
    public function index() {
        return view('admin.content-management.success-story.index');
    }

    public function successStoryLists()
    {
        $data = SuccessStory::orderBy('id', 'desc');

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->editColumn('image', function($each) {

                $src = $each->image ? asset('storage').$each->image : asset('storage/images/default.jpg');

                $image = "<img src='$src' style='height: 50px; width: 50px; border-radius: 100%; object-fit: cover; border: 1px solid #333;'/>";

                return $image;
            })

            ->addColumn('action', function ($each) {

                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                $show_icon = '<a href="' . route('admin.success-story.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';

                $edit_icon = '<a href="'.route('admin.success-story.edit', $each->id).'" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';

                $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['image',  'action'])
            ->make(true);

    }

    public function create() {
        return view('admin.content-management.success-story.create');
    }

    public function store(Request $request) {
        DB::beginTransaction();

        try {
            if ($request->file('image')) {
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/images/content_images', $fileName);
            }

            $successStory = new SuccessStory();
            $successStory->date = $request->date;
            $successStory->stu_name = $request->stu_name;
            $successStory->college_name = $request->college_name;
            $successStory->image = $fileName ? '/images/content_images/' . $fileName : null;
            $successStory->save();

            DB::commit();
            session()->flash('success', 'Successfully Created !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }

    public function show(SuccessStory $successStory)  {
        return view('admin.content-management.success-story.show', compact('successStory'));
    }

    public function edit(SuccessStory $successStory) {
        return view('admin.content-management.success-story.edit', compact('successStory'));
    }

    public function updateSuccessStory(Request $request, SuccessStory $successStory) {
        DB::beginTransaction();

        try {
            $fileName = null;
            if ($request->file('image')) {

                //delete old file
                \File::delete(public_path('/storage' . $successStory->image));

                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/images/content_images', $fileName);
            }

            $successStory->date = $request->date;
            $successStory->stu_name = $request->stu_name;
            $successStory->college_name = $request->college_name;
            $successStory->image = $fileName ? '/images/content_images/' . $fileName : $successStory->image;
            $successStory->save();

            DB::commit();
            session()->flash('success', 'Successfully Updated !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }

    public function destroy(SuccessStory $successStory) {
        DB::beginTransaction();

        try {
            \File::delete(public_path('/storage' . $successStory->image));
            $successStory->delete();

            DB::commit();
            return 'success';
        }catch(\Exception $err) {
            DB::rollBack();
            return $err->getMessage();
        }
    }
}
