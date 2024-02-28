<?php

namespace App\Http\Controllers;

use App\Models\RequestCategory;
use Illuminate\Http\Request;

class RequestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
