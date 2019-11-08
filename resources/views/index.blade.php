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
      <form method="POST" action="/book-catalog">
      <div class="form-group {{$display}}" >
            @csrf
              <label for="bookInput" class="h4">Enter a Book</label>
              <input type="text" class="form-control mb-1" name="title" placeholder="Enter Title">
              <input type="text" class="form-control mb-1" name="author" placeholder="Enter Author">
              <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
      </form>
      <tbody>
         @foreach($books as $book)
         {{-- @foreach($delete as $del) --}}
      <tr>
         <td>{{ $book->id }}</td>
         <td>{{ $book->title }}</td>
         <td>
            {{ $book->author }}
            <form class="{{$display}}" method="POST" action="books/remove">
               @csrf
               @method('DELETE')
            <input type="hidden" name="delete_book" value="{{$book->id}}" />
            <input type="submit" class="btn btn-danger float-right" value="Delete" />
            </form>
         </td>
      </tr>
      {{-- @endforeach --}}
      @endforeach
      </tbody>
   </table>
</div>

@endsection