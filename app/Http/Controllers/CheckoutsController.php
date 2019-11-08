<?php

namespace App\Http\Controllers;

use App\Books;
use App\Checkouts;
use DB;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Auth;

class CheckoutsController extends Controller
{

    public function index() {
        $books = Books::all();

        $librarian = DB::table('users')->where('id' , Auth::user()->id)->get();
        $display='';
        if ($librarian[0]->librarian != 1) {
            $display = "d-none";
        }

        return view('index', [
            'books' => $books,
            'display' => $display
        ]);
    }

    public function create(Request $request) {
        
        $book = new Books();
        $book->title = $request->title;
        $book->author = $request->author;

        $book->save();

        return redirect('/book-catalog');

    }

    public function remove(Request $request) {
    
        $delete = Books::find($request->delete_book);

        $delete->delete();
        return redirect('/book-catalog');

    }

    public function show() {
        $checkouts = DB::table('checkouts')->get();

        $output_data = [];
        for ($i = 0; $i < count($checkouts); $i++) {
            $obj = new stdClass();
            $obj->id = $checkouts[$i]->id;
            $obj->user_name = DB::table('users')->where('id', '=', $checkouts[$i]->user_id)->get()[0]->name;
            $obj->book_title = DB::table('books')->where('id', '=', $checkouts[$i]->book_id)->get()[0]->title;
            $obj->book_author = DB::table('books')->where('id', '=', $checkouts[$i]->book_id)->get()[0]->author;
          
            array_push($output_data, $obj);
        }

        $librarian = DB::table('users')->where('id' , Auth::user()->id)->get();
        $display='';
        if ($librarian[0]->librarian != 1) {
            $display = "d-none";
        }
        return view('checkouts', [
            'checkouts' => $output_data,
            'display' => $display
        ]);
    }


    public function available() {

        $books = Books::all();
        $checkouts = DB::table('checkouts')->get();

        $available_books = [];
        for ($i = 0; $i < count($books); $i++) {
            $obj = new stdClass();
            $obj->id = $books[$i]->id;

           $checked_out_book = DB::table('checkouts')->where('book_id', '=', $books[$i]->id)->get();

        if (count($checked_out_book) == 0) {
            $book = Books::find($books[$i]->id);
            $obj->author = $book->author;
            $obj->title = $book->title;

            array_push($available_books, $obj);
            
            }
        }
        //dd($available_books);
        return view('available', [
            'available_books' => $available_books,
        ]);
    }

    public function checkout(Request $request) {
        
        $checkout = new Checkouts();
        $checkout->book_id = $request->book_id;
        $checkout->user_id = Auth::id();

        $checkout->save();
        return redirect('/available');
    }

    public function destroy(Request $request) {
    
        $checkout = Checkouts::find($request->checkout_id);

        $checkout->delete();
        return redirect('/checked-out');

    }

}
