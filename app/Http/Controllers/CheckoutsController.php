<?php

namespace App\Http\Controllers;

use App\Books;
use App\Checkouts;
use DB;
use Illuminate\Http\Request;
use stdClass;

class CheckoutsController extends Controller
{

    public function index() {
        $books = Books::all();
        return view('index', ['books' => $books]);
    }


    public function show() {
        $checkouts = DB::table('checkouts')->get();

        $output_data = [];
        for ($i = 0; $i < count($checkouts); $i++) {
            $obj = new stdClass();
            $obj->id = $checkouts[$i]->id;
            $obj->user_name = DB::table('users')->where('id', '=', $checkouts[$i]->user_id)->get()[0]->name;
            $obj->book_title = DB::table('books')->where('id', '=', $checkouts[$i]->book_id)->get()[0]->title;
          
            array_push($output_data, $obj);
        }
        
        return view('checkouts', [
            'checkouts' => $output_data,
        ]);
    }

}
