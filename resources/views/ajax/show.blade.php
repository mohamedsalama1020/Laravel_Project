@extends('layouts.app')
@section('content')

   <div class="alert alert-success" id="success-msg" style="display: none;">
            Offer deleted successfully
        </div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{__('messages.offername')}}</th>
      <th scope="col">{{__('messages.offerprice')}}</th>
      <th scope="col">{{ __('messages.offerdetails') }}</th>
      <th scope="col">Image</th>
      <th scope="col">{{ __('messages.edit') }}</th>
      <th scope="col">{{ __('messages.delete') }}</th>




    </tr>
  </thead>
  <tbody>
     @foreach ($offers as $offer)
    
    <tr class="offerRow{{ $offer->id }}">
        
      <th scope="row">{{ $offer->id }}</th>
      <td>{{ $offer->name }}</td>
      <td>{{ $offer->price }}</td>
      <td>{{ $offer->details }}</td>
      <td>
    <img src="{{ asset('images/offers/' . $offer->image) }}" width="150" height="100" alt="Offer Image">
    </td>

      
      <td><a href="{{ route('ajax.edit',$offer->id) }}"  class="btn btn-success">{{ __('messages.edit')}}</a> </td>
      <td><a href="" offer_id="{{ $offer->id }}" class="delete-btn btn btn-danger">{{ __('messages.delete')}}</a> </td>

    </tr>
    @endforeach
    
  </tbody>
</table>
@endsection

@section('scripts')
<script>

    $(document).on('click','.delete-btn',function(e){
    
        e.preventDefault();

        var offer_id =$(this).attr('offer_id');
        $.ajax({
        type:'post',
        url:"{{ route('ajax.delete') }}",

        data:{

            '_token':"{{ csrf_token() }}",
            'id':offer_id
        },
        
        
        
        success:function(data){
            if(data.status==true){
                $('#success-msg').show();
            
            }

            $('.offerRow' + data.id).remove();
                
        },

        error:function(reject){},

    });
    });
</script>


@endsection


    
