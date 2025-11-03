@extends('layouts.app')
@section('content')

<div class="flex-center position-ref full-height ">
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
         <div class="alert alert-success" id="success-msg" style="display: none;">
            Offer added successfully
        </div>
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">

            <div style="text-align: center;">
                 <h1>{{ __('messages.addoffer') }}</h1>
            
            @if (Session::has('success'))
            
           
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
             @endif
             <br>
            <form method="POST" id="offerForm" action="{{ route('ajax.save') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="EnterOffer">{{ __('messages.offername_en') }}</label>
                <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.EnterName')}}">
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
                @error('image')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerprice') }}</label>
                <input type="text" class="form-control" name="price" placeholder="Price">
                 @error('price')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
    
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_ar') }}</label>
                <input type="text" class="form-control" name="details_ar" placeholder="Enter Details">
                @error('details_ar')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
   
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_en') }}</label>
                <input type="text" class="form-control" name="details_en" placeholder="Enter Details">
                @error('details_en')
                <small class="form-text text-danger">{{ $message }}</small>

                @enderror
            </div>
            <br>
            <button id="save" class="btn btn-primary">{{ __('messages.save')}}</button>
            </form>
            </div>
    </body>
  </div>
</div>

@endsection
@section('scripts')
<script>

    $(document).on('click','#save',function(e){
    
        e.preventDefault();

        var formData = new FormData($('#offerForm')[0]);
        $.ajax({
        type:'post',
        enctype:'multipart/form-data',
        url:"{{ route('ajax.save') }}",
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