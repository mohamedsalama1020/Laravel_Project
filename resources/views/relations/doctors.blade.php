@extends('layouts.app')
@section('content')

<div class="class container">
    <div class="class flex-center position-ref full-height">
        <div class="class content">
            <div class="class title">
                Doctors
            </div>
        </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Title</th>
      <th scope="col">Show Specialties</th>
    </tr>
  </thead>
  <tbody>
    @if ($doctors->isNotEmpty())  
    @foreach ($doctors as $d)

    <tr>
      <th scope="row">{{$d->id}}</th>
      <td>{{$d->name}}</td>
      <td>{{$d->title}}</td>
      <td><a href="{{ route('specialties',$d->id) }}" class="btn btn-success">Show</a></td>
    @endforeach
     @endif
  </tbody>
</table>
</div>
</div>
@endsection