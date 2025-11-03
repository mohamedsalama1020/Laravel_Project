@extends('layouts.app')
@section('content')

         <div class="alert alert-success" id="success-msg" style="display: none;">
            Offer updated successfully
        </div>
  <div class="container">

            <div style="text-align: center;">
                 <h1>{{ __('messages.addoffer') }}</h1>
            
             <br>
            <form method="POST" id="offerFormUpdate" action="{{ route('ajax.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
            <div class="form-group">
                <label for="EnterOffer">{{ __('messages.offername_en') }}</label>
                <input type="text" class="form-control" name="name_en" value="{{ $offer->name_en }}" placeholder="{{__('messages.EnterName')}}">
                @error('name_en')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
              <div class="form-group">
                <label for="EnterOffer">{{ __('messages.offername_ar') }}</label>
                <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.EnterName')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="EnterOffer">{{ __('messages.addimage') }}</label>
                <input type="file" class="form-control" name="image" placeholder="{{__('messages.imageph')}}">
                <img src="{{ asset('images/offers/' . $offer->image) }}" width="120" style="margin-top:10px;">
                @error('image')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerprice') }}</label>
                <input type="text" class="form-control" name="price" value="{{ $offer->price }}" placeholder="Price">
                 @error('price')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
    
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_ar') }}</label>
                <input type="text" class="form-control" name="details_ar" value="{{ $offer->details_ar }}" placeholder="Enter Details">
                @error('details_ar')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
   
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_en') }}</label>
                <input type="text" class="form-control" name="details_en" value="{{ $offer->details_en }}" placeholder="Enter Details">
                @error('details_en')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
            <br>
            <button id="update" class="btn btn-primary">{{ __('messages.updateoffer')}}</button>
            </form>
            </div>
    </body>
  </div>
</div>

@endsection
@section('scripts')
<script>

    $(document).on('click','#update',function(e){
    
        e.preventDefault();

        var formData = new FormData($('#offerFormUpdate')[0]);
        $.ajax({
        type:'post',
        enctype:'multipart/form-data',
        url:"{{ route('ajax.update') }}",
        data:formData,
        processData:false,
        contentType:false,
        cache:false,

        success:function(data){
            if(data.status==true){
                $('#success-msg').show();
            
            }
                
        },

        error:function(reject){},

    });
    });
</script>

@endsection