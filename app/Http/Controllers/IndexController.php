<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class IndexController extends Controller
{
    //
    public function index(){

        $response = Http::get('https://www.omdbapi.com/?s=Batman&page=1&apikey=32f246bc');
        // $data1 = $response->body();  
        $obj = json_decode($response,true);
        // echo dd($m['Search']);
        $dataMovie =$obj['Search'];

        $data = Movie::latest()->paginate(5);
        // $data = Movie::first()->paginate(5);
        return view('movies.index',compact('data','dataMovie'))
                ->with('i',(request()->input('page', 1) -1) * 5);
       
    }
}
