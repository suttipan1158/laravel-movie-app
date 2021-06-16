<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\User;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //                
        $response = Http::get('https://www.omdbapi.com/?s=Batman&page=1&apikey=32f246bc');
        // $data1 = $response->body();  
        $obj = json_decode($response,true);
        // echo dd($m['Search']);
        $dataMovie =$obj['Search'];  

        $data = Movie::latest()->paginate(5);
        // $data = Movie::first()->paginate(5);
        $storMovie = [];
        foreach($data as $value){  
            if(auth()->user()->id == $value->user_id){
                $movielist = [
                    $value-> user_id,
                    $value-> Title ,
                    $value-> Year ,
                    $value-> Type ,
                    $value-> Poster ,
                ];
                $storMovie = $movielist;
            }
        }
        
        return view('movies.index',compact('data','dataMovie'))
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
        // $request->validate([
        //     'user_id'=>'required',
        //     'Title'=>'required',
        //     'Year'=>'required',
        //     'Type'=>'required',
        //     'Poster'=>'required'
        // ]);

        // Movie::create($request->all());
        // return redirect()->route('movies.create')
        // ->with('success','Movie created successfully.');

    }
    public function insertMovie($id,$uid){
        $response = Http::get('https://www.omdbapi.com/?s=Batman&page=1&apikey=32f246bc');
        $obj = json_decode($response,true);
        $dataMovie =$obj['Search'];

        $stores = [];
        $movie = new Movie;
        foreach($dataMovie as $value){
            $mid = $value['imdbID'];
            if($id === $mid){
                $movie-> user_id = $uid;
                $movie-> Title =$value['Title'];
                $movie-> Year =$value['Year'];
                $movie-> Type =$value['Type'];
                $movie-> Poster =$value['Poster'];
                $movie->save();
            }
        }
        return redirect()->route('movies.index')
        ->with('success','Movie created successfully.');
    }
   
    public function show(Movie $movie)
    {
        //
        return view('movies.show',compact('movie'));
    }

  
    public function edit(Movie $movie)
    {
        
        return view('movies.edit',compact('movie'));
    }

    
    public function update(Request $request, Movie $movie)
    {
        //
        $request->validate([
            'user_id'=>'required',
            'Title'=>'required',
            'Year'=>'required',
            'Type'=>'required',
            'Poster'=>'required'
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')
                ->with('success','Movie update successfully.');
    }

    public function destroy(Movie $movie)
    {
        //
        $movie->delete();

        return redirect()->route('movies.index')
                ->with('success','Movie delete successfully.');
    }
}
