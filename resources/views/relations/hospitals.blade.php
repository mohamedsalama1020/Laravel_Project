@extends('layouts.app')
@section('content')
<div class="class container">
    <div class="class flex-center position-ref full-height">
        <div class="class content">
            <div class="class title">
                Hospitals
            </div>
        </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Show Doctors</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @if ($hospitals->isNotEmpty())
        @foreach ($hospitals as $h)
        <tr>
            <th scope="row">{{$h->id}}</th>
            <td>{{$h->name}}</td>
            <td>{{ $h->address }}</td>
            <td><a href="{{ route('doctors',$h->id) }}" class="btn btn-success">Show</a> </td>
            <td><a href="{{ route('delete',$h->id) }}" class="btn btn-danger">Delete</a> </td>
       
          </tr>
    
  </tbody>
   @endforeach
  @endif
</table>
</div>
</div>

@endsection