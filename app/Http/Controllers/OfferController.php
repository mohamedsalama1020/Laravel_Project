<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;


class OfferController extends Controller
{

    use OfferTrait;
    public function create(){
        return view('ajax.offer');
    }


    public function save(OfferRequest $request){
        
        $file_name= $this->saveImage($request->image,'images/offers');
        $offer = Offer::create([
            'image'=>$file_name,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'details_en'=>$request->details_en,
            'details_ar'=>$request->details_ar,

        ]);

        if($offer)
            return response()->json([
                'status'=>true,
                'msg'=>'Offer added successfully',
            ]);
        else
             return response()->json([
                'status'=>false,
                'msg'=>'try again!',
  
            ]);


    }
    public function show()  {
         $offers = Offer::select('id',
        'name_' .FacadesLaravelLocalization::getCurrentLocale() . ' as name',
        'price',
        'details_' .FacadesLaravelLocalization::getCurrentLocale() . ' as details',
        'image'
        
        )->get();
        return view('ajax.show',compact('offers'));
        
    }
    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer)
            return redirect()->back()->with('error','not found');
        $offer->delete();
       return response()->json([
                'status'=>true,
                'msg'=>'Offer deleted successfully',
                'id'=>$request->id

       ]);
    }

     public function edit(Request $request){
        $found= Offer::find($request->offer_id);
        if(!$found)
            return response()->json([
                'status'=>false,
                'msg'=>'not found!',
            ]);
        
            $offer = Offer::select('id','name_en','price','details_en','image')->find($request-> offer_id);
            return view('ajax.edit',compact('offer'));

    }

    public function update(Request $request){

        $offer = Offer::find($request->offer_id);
        if(!$offer)
            return response()->json([
                'status'=>false,
                'msg'=>'not found!']);

        $offer->update($request->all());
            return response()->json([
                'status'=>true,
                'msg'=>'Offer updated successfully',
                ]);
    }
}
