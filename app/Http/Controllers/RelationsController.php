<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use phpseclib3\Crypt\EC;

class RelationsController extends Controller
{
    public function has_one(){
        $user = User::with(['phone'=>function($q){

            $q ->select('code','number','user_id');
        }])->find(5);
        //return $user->phone->code;
        return response()->json($user);

    }

    public function has_one_rev(){
        //$phone = Phone::find(1);
        $phone = Phone::with(['user'=>function($q){
            $q -> select('id','name','age','email');


        }])->find(4);

        // make a hidden variable visible 
        // makeVisible(['user_id']) makeHidden(['id'])
        //return $phone ->user;
        return $phone;


    }

    public function user_has_phone(){
        
        //return User::whereHas('phone')->get();

        return User::whereHas('phone',function($q){

            $q -> where('code',operator: 966);

        })->get();
    }
    public function user_notHas_phone(){


        return User::whereDoesntHave('phone')->get();
    }
    public function getHospitalDocators(){
        //$hospital = Hospital::where('id',2)->first();//Hospital::find(1); //Hospital::first();
        $hospital = Hospital::with('doctors')->find(1);
        /*$doctors = $hospital->doctors;
        //return $hospital->doctors;
        foreach($doctors as $doc)
            echo $doc->name . '<br>'; */
        

        $doctor = Doctor::find(3);
        return $doctor->hospital;
        }

        public function hospitals(){

            $hospitals = Hospital::select('id','name','address')->get();
            return view('relations.hospitals',compact('hospitals'));
        }

        public function doctors($hospital_id){
            $hospital = Hospital::find($hospital_id);
            $doctors = $hospital->doctors;
            return view('relations.doctors',compact('doctors'));
        }

        public function hospitalsHasDoctors(){
            return Hospital::whereHas('doctors')->get();
        }

       public function doctors_male()
            {
                return Hospital::with(['doctors' => function ($q) {
                    $q->where('gender', 'male');
                }])
                ->whereHas('doctors', function ($q) {
                    $q->where('gender', 'male');
                })
                ->get();        
        }
        public function hospitalsNotHasDoctors(){
            return Hospital::whereDoesntHave('doctors')->get();
        }
        public function delete_hospitals($hospital_id){

            $hospital = Hospital::findOrFail($hospital_id);

            //$hospital -> doctors() -> delete();
            $hospital -> delete();
            return redirect()->back()->with('success','Deleted Successfully');

        }
        public function getDoctors_services(){

            return Doctor::with('services')->find(1);
            //return $doctor -> services;
    }

    public function getServices_doctors(){

             return  Service::with('doctors')->find(1);
            //return $service -> doctors;
    }

    public function show_specialties($doctor_id)  {
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;

        $doctors = Doctor::select('id','name')->get();
        $allservices = Service::select('id','name')->get();
        return view('relations.specialties',compact('services','allservices','doctors'));
    }
    public function add_specialties(Request $request){
        $doctor = Doctor::findOrFail($request->doctor_id);
        //$doctor->services()->attach($request->services_ids); add with duplication
        //$doctor->services()->sync($request->services_ids); // without and remove the old(with attach)
        $doctor->services()->syncWithoutDetaching($request->services_ids); // Without Detaching
        return redirect()->back();
    }

    public function getPatientDoctor(){

        $patient = Patient::find(2);
        return $patient -> doctor;

    }

    public function getHospitalDoctors(){

        $country = Country::find(1);
        return $country -> doctors;

    }


}
