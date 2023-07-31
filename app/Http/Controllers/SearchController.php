<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index()
    {

        $data = User::all();

        return view('welcome', [
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {

        // dd($request->all());

        $q = $request->input('search_input');
        $semakan = User::where('name', 'LIKE', '%' . $q . '%')
        ->orWhere('email', 'LIKE', '%' . $q . '%')
        ->orWhere('status', 'LIKE', '%' . $q . '%')
        ->get();

        if (count($semakan) > 0) {
            // return view('welcome')->withDetails($semakan)->withQuery($q);

            return response()->json($semakan);
        } else {
            // return view('welcome')->withMessage('No Details found. Try to search again !');
            return response()->json("Sorry no data");
        }
    }

    public function result(Request $request)
    {
        return response()->json($request);
    }
}
