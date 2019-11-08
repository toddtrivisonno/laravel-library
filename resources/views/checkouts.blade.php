@extends('layouts.app')

@section('content')

<div class="container">
   <table class="table table-striped table-bordered">
      <thead>
      <tr>
         <th scope="col">Checkout ID</th>
         <th scope="col">Cardholder</th>
         <th scope="col">Title</th>
         <th scope="col">Author</th>
      </tr>
      </thead>
      <tbody>
         @foreach($checkouts as $checkout)
      <tr>
         <td>{{ $checkout->id }}</td>
         <td>{{ $checkout->user_name }}</td>
         <td>{{ $checkout->book_title }}</td>
         <td>
            {{ $checkout->book_author }}
            
         <form class="{{$display}}" method="POST" action="books/checkout">
               @csrf
               @method('DELETE')
               <input type="hidden" name="checkout_id" value="{{ $checkout->id }}" />
            <input type="submit" class="btn btn-primary float-right" value="Return" />
            </form>
         </td>
      </tr>
      @endforeach
      </tbody>
   </table>
</div>

@endsection