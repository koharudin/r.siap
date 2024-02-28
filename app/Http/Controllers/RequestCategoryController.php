<?php

namespace App\Http\Controllers;

use App\Models\RequestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->input('q');
        $query = RequestCategory::query();
        $query->orderBy('name', 'asc');
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('name', 'ilike', "%" . strtolower($q) . "%");
            });
        }

        return $query->get();
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
        $validator = Validator::make(request()->all(), [
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $record = new RequestCategory();
        $record->name = request()->input("name");
        $record->save();

        return response()->json($record, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RequestCategory $requestCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestCategory $requestCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestCategory $requestCategory)
    {
        $validator = Validator::make(request()->all(), [
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $requestCategory = new RequestCategory();
        $requestCategory->name = request()->input("name");
        $requestCategory->save();

        return response()->json($requestCategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestCategory $requestCategory)
    {
        //
        $requestCategory->delete();
        return response()->json($requestCategory, 200);
    }
}
