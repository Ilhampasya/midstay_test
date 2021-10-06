<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighboorhoodRequest;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neighborhoods = Neighborhood::latest()
                    ->paginate(5);

        return view('neighborhoods.index', compact('neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('neighborhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NeighboorhoodRequest $request)
    {
        DB::beginTransaction();

        try {
            Neighborhood::create($request->all());

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('neighborhoods.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('neighborhoods.index')->withStatus('The neighborhood has been created.');
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
    public function edit(Neighborhood $neighborhood)
    {
        return view('neighborhoods.edit', compact('neighborhood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NeighboorhoodRequest $request, Neighborhood $neighborhood)
    {
        DB::beginTransaction();

        try {
            $neighborhood->update($request->all());    

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('neighborhoods.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('neighborhoods.index')->withStatus('The neighborhood has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighborhood $neighborhood)
    {
        DB::beginTransaction();

        try {
            $neighborhood->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('neighborhoods.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('neighborhoods.index')->withStatus('The neighborhood has been deleted.');
    }
}
