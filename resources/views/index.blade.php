@extends('layouts.app')

@section('content')

<div class="container">
   <table class="table table-striped table-bordered">
      <thead>
      <tr>
         <th scope="col">Title</th>
         <th scope="col">Author</th>
      </tr>
      </thead>
      <tbody>
         @foreach($books as $book)
      <tr>
         <td>{{ $book->title }}</td>
         <td>{{ $book->author }}</td>
      </tr>
      @endforeach
      </tbody>
   </table>
</div>

@endsection