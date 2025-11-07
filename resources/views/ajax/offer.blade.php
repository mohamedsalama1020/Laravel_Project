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
                <small id="name_en_error" class="form-text text-danger"></small>
                
            </div>
              <div class="form-group">
                <label for="EnterOffer">{{ __('messages.offername_ar') }}</label>
                <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.EnterName')}}">
                
                <small id="name_ar_error" class="form-text text-danger"></small>
               
            </div>

            <div class="form-group">
                <label for="EnterOffer">{{ __('messages.addimage') }}</label>
                <input type="file" class="form-control" name="image" placeholder="{{__('messages.imageph')}}">
                
                <small id="image_error" class="form-text text-danger"></small>
                
            </div>

            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerprice') }}</label>
                <input type="text" class="form-control" name="price" placeholder="Price">
                 
                <small id="price_error" class="form-text text-danger"></small>

                
            </div>
    
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_ar') }}</label>
                <input type="text" class="form-control" name="details_ar" placeholder="Enter Details">
                
                <small id="details_ar_error" class="form-text text-danger"></small>

                
            </div>
   
            <div class="form-group">
                <label for="EnterOfferName">{{ __('messages.offerdetails_en') }}</label>
                <input type="text" class="form-control" name="details_en" placeholder="Enter Details">
                
                <small id="details_en_error" class="form-text text-danger"></small>

                
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
        // # is id . is class
    
        e.preventDefault();
        $('#name_en_error').text('');
        $('#name_ar_error').text('');
        $('#image_error').text('');
        $('#price_error').text('');
        $('#details_ar_error').text('');
        $('#details_en_error').text('');

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

        error:function(reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors,function(key,val){
                $("#" + key + "_error").text(val[0]);
            });


        },

    });
    });
</script>

@endsection