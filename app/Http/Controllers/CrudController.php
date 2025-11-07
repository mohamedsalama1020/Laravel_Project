<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;

use function Laravel\Prompts\select;

class CrudController extends Controller
{

    use OfferTrait;
    public function getOffers(){
        return Offer::select('name')->get();
    }

    public function create(){
        return view('offers.create');

        }
    public function store(OfferRequest $request){

        $file_name= $this->saveImage($request->image,'images/offers');
        Offer::create([
            'image'=>$file_name,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'details_en'=>$request->details_en,
            'details_ar'=>$request->details_ar,

        ]);
         return redirect()->route('offers.show')->with(['success'=>'The offer is done']);   
   
    }
    /*public function show(){
        $offers = Offer::select('id',
        'name_' .FacadesLaravelLocalization::getCurrentLocale() . ' as name',
        'price',
        'details_' .FacadesLaravelLocalization::getCurrentLocale() . ' as details',
        'image'
        
        )->get();
        return view('offers.show',compact('offers'));
    }*/

        // function show() with pagination
        public function show(){
        $offers = Offer::select('id',
        'name_' .FacadesLaravelLocalization::getCurrentLocale() . ' as name',
        'price',
        'details_' .FacadesLaravelLocalization::getCurrentLocale() . ' as details',
        'image'
        
        )->paginate(PAGINATION_COUNT);
        return view('offers.showPagination',compact('offers'));
    }

    public function editOffer($id){
        $found= Offer::find($id);
        if(!$found)
            return redirect()->back();
        
        $offer = Offer::select('id','name_ar','name_en','price','details_en','image','details_ar')->find($id);
        return view('offers.edit',compact('offer'));

    }

    public function update(OfferRequest $request,$id){

        $offer = Offer::find($id);
        if(!$offer)
            return redirect()->back()->with(['error' => 'Offer not found']);
        $offer->update($request->all());
        return redirect()->route('offers.show')->with(['success' => 'Updated Successfully']);

    }
    public function delete($id){
        $offer = Offer::find($id);
        if(!$offer)
            return redirect()->back()->with('error','not found');
        $offer->delete();
        return redirect()->route('offers.show')->with('success','deleted successfully');

    }
    
    public function valid_offers(){
        //return Offer::active()->get();  local scope
        // return active offers with global scope

        //return  Offer::get();
        // remove global scope
        return Offer::withoutGlobalScope(OfferScope::class)->get();


    }
    // test accessors and mutatotrs
    public function get_Offers(){
        return Offer::select('id','name_en','status')->get();

    }



}