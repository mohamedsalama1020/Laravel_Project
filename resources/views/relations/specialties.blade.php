@extends('layouts.app')
@section('content')

<div class="class container">
    <div class="class flex-center position-ref full-height">
        <div class="class content">
            <div class="class title">
                Specialties
            </div>
        </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
    </tr>
  </thead>
  <tbody>
    @if ($services->isNotEmpty())  
    @foreach ($services as $s)

    <tr>
      <th scope="row">{{$s->id}}</th>
      <td>{{$s->name}}</td>      
    @endforeach
     @endif
  </tbody>
</table>
<br><br>
<form method="POST" action="{{ route('addspecialties') }}">
            @csrf
            <div class="form-group">
                <label for="doctors">Doctors</label>
                <select class="form-control" name="doctor_id">
                  @if ($doctors->isNotEmpty())
                    @foreach ($doctors as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                    
                    @endif

                </select>
            </div>
            <div class="form-group">
                <label for="services">Specialties</label>
                <select class="form-control" name="services_ids[]" multiple>
                  @if ($allservices->isNotEmpty())
                    @foreach ($allservices as $s)
                  <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                    
                    @endif
                  </option>

                </select>
            </div>
          
            <br>
            <button id="save" class="btn btn-primary">{{ __('messages.save')}}</button>
            </form>
</div>
</div>
@endsection