@extends('layouts.app')

@section('content')

<div class="container">
   <table class="table table-striped table-bordered">
      <thead>
      <tr>
         <th scope="col">Book ID</th>
         <th scope="col">Title</th>
         <th scope="col">Author</th>
      </tr>
      </thead>
      <tbody>
         @foreach($available_books as $available_book)
      <tr>
         <td>{{ $available_book->id }}</td>
         <td>{{ $available_book->title }}</td>
         <td>
            {{ $available_book->author }}
            <form method="POST" action="books/checkout">
               @csrf
               <input type="hidden" name="book_id" value="{{ $available_book->id }}" />
               <input type="submit" class="btn btn-primary float-right" value="Check Out" />
            </form>
         </td>
      </tr>
      @endforeach
      </tbody>
   </table>
</div>

@endsection