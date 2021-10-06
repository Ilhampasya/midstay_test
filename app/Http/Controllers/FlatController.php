<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlatRequest;
use App\Models\Flat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::with('neighborhood')
                ->latest()
                ->paginate(5);

        return view('flats.index', compact('flats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlatRequest $request)
    {
        DB::beginTransaction();

        try {
            Flat::create($request->all());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('flats.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('flats.index')->withStatus('The flat has been created.');
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
    public function edit(Flat $flat)
    {
        return view('flats.edit', compact('flat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlatRequest $request, Flat $flat)
    {
        DB::beginTransaction();

        try {
            $flat->update($request->all());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('flats.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('flats.index')->withStatus('The flat has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        DB::beginTransaction();

        try {
            $flat->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('flats.index')->withStatus('Something went wrong.');
        }

        return redirect()->route('flats.index')->withStatus('The flat has been deleted.');
    }
}
