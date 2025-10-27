<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    public function getOffers(){
        return Offer::select('name')->get();
    }

    public function create(){
        return view('offers.create');

        }
            public function store(Request $request){

        $rules=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required',];

           $messages= $this->getMessages();
            $validator = Validator::make($request->all(),$rules,$messages);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());

        }
       
    

        Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details,

        ]);
         return redirect()->back()->with(['success'=>'The offer is done']);   
    }
    

    protected function getMessages(){

         return   [
                'name.required'=>__('messages.offerNameReq'),
                'name.unique'=>trans('messages.offerNameUni'),
                'price.required'=>__('messages.offerPriceReq'),

                'price.numeric'=>__('messages.offerPriceNum'),
            ];
    }
}     