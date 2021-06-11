<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Movie::latest()->paginate(5);
        return view('movies.index',compact('data'))
                ->with('i',(request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('movies.create');
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
        // print("KO"+ $request);
        $request->validate([
            'imdbID'=>'required',
            'user_id'=>'required',
            'Title'=>'required',
            'Year'=>'required',
            'Type'=>'required',
            'Poster'=>'required'
        ]);

        Movie::create($request->all());

         return redirect()->route('movies.index')
                ->with('success','Movie created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
        // return view('movies.show',compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
        // return view('movies.edit',compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
        $request->validate([
            'imdbID'=>'required',
            'user_id'=>'required',
            'Title'=>'required',
            'Year'=>'required',
            'Type'=>'required',
            'Poster'=>'required'
        ]);

        $movie->update($request->all());

        // return redirect()->route('movie.index')
        //         ->with('success','Movie update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
        $movie->delete();

        // return redirect()->route('movies.index')
        //         ->with('success','Movie delete successfully.');
    }
}
