@extends('layouts.app')

@section('content')

<div class="container">
   <table class="table table-striped table-bordered">
      <thead>
      <tr>
         <th scope="col">Checkout ID</th>
         <th scope="col">Cardholder</th>
         <th scope="col">Title</th>
      </tr>
      </thead>
      <tbody>
         @foreach($checkouts as $checkout)
      <tr>
         <td>{{ $checkout->id }}</td>
         <td>{{ $checkout->user_name }}</td>
         <td>{{ $checkout->book_title }}</td>
      </tr>
      @endforeach
      </tbody>
   </table>
</div>

@endsection