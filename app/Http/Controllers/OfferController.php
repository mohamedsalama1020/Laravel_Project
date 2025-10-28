<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;

use function Laravel\Prompts\select;

class OfferController extends Controller
{
    public function getOffers(){
        return Offer::select('name')->get();
    }

    public function create(){
        return view('offers.create');

        }
    public function store(OfferRequest $request){
        
        Offer::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'details_en'=>$request->details_en,
            'details_ar'=>$request->details_ar,

        ]);
         return redirect()->back()->with(['success'=>'The offer is done']);   
   
    }
    public function show(){
        $offers = Offer::select('id',
        'name_' .FacadesLaravelLocalization::getCurrentLocale() . ' as name',
        'price',
        'details_' .FacadesLaravelLocalization::getCurrentLocale() . ' as details',
        
        )->get();
        return view('offers.show',compact('offers'));
    }

    public function editOffer($id){
        $found= Offer::find($id);
        if(!$found)
            return redirect()->back();
        
        $offer = Offer::select('id','name_ar','name_en','price','details_en','details_ar')->find($id);
        return view('offers.edit',compact('offer'));

    }

    public function update(OfferRequest $request,$id){

        $offer = Offer::find($id);
        if(!$offer)
            return redirect()->back()->with(['error' => 'Offer not found']);
        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'Updated Successfully']);




    }


}