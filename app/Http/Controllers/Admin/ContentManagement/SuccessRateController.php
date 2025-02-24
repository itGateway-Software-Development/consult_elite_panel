<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Models\SuccessRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;

class SuccessRateController extends Controller
{
    public function index()
    {
        return view('admin.content-management.success-rate.index');
    }

    public function successRateLists()
    {
        $data = SuccessRate::orderBy('order_number', 'asc');

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })

            ->editColumn('description_eng', function($each) {
                $plainText = strip_tags($each->description_eng);
                return mb_substr($plainText, 0, 200) . ' ...';
            })

            ->editColumn('description_mm', function($each) {
                $plainText = strip_tags($each->description_mm);
                return mb_substr($plainText, 0, 200) . ' ...';
            })


            ->addColumn('action', function ($each) {

                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                $show_icon = '<a href="' . route('admin.success-rate.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                // if (auth()->user()->can('photo_gallery_show')) {
                // }

                $edit_icon = '<a href="'.route('admin.success-rate.edit', $each->id).'" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';

                $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns([ 'content_eng', 'content_mm', 'action'])
            ->make(true);

    }

    public function create() {
        return view('admin.content-management.success-rate.create');
    }

    public function store(Request $request) {
        DB::beginTransaction();

        try {
            $successRate = new SuccessRate();
            $successRate->rate_count_eng = $request->rate_count_eng;
            $successRate->rate_count_mm = $request->rate_count_mm;
            $successRate->order_number = $request->order_number;
            $successRate->description_eng = $request->description_eng;
            $successRate->description_mm = $request->description_mm;
            $successRate->save();

            DB::commit();
            session()->flash('success', 'Successfully Created !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            logger($err->getMessage());
            return response()->json($err->getMessage());
        }
    }

    public function show(SuccessRate $successRate) {
        return view('admin.content-management.success-rate.show', compact('successRate'));
    }

    public function edit(SuccessRate $successRate) {
        return view('admin.content-management.success-rate.edit', compact('successRate'));
    }

    public function updateSuccessRate(Request $request, SuccessRate $successRate) {
        DB::beginTransaction();

        try {
            $successRate->rate_count_eng = $request->rate_count_eng;
            $successRate->rate_count_mm = $request->rate_count_mm;
            $successRate->order_number = $request->order_number;
            $successRate->description_eng = $request->description_eng;
            $successRate->description_mm = $request->description_mm;
            $successRate->update();

            DB::commit();
            session()->flash('success', 'Successfully Updated !');
            return 'success';
        } catch (\Exception $err) {
            DB::rollBack();
            logger($err->getMessage());
            return response()->json($err->getMessage());
        }
    }

    public function destroy(SuccessRate $successRate) {
        $successRate->delete();
        return 'success';
    }
}
