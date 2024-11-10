<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;


class PersonController extends Controller
{
    public function get(){
        try { 
            $data = Person::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function create(Request $request){
        try {

           $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:person,email',
                'position' => 'required|integer',
                'password' => 'required|string|min:8',
                'cep' => 'required|string|max:10',
            ]);

            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['position'] = $request['position'];
            $data['password'] = Hash::make($request['password']);
            $data['cep'] = $request['cep'];
            $res = Person::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id){
        try { 
           // $data = Person::find($id);
           $person = Person::select('id', 'name')->find($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try { 
            $data['name'] = $request['name'];
            $data['address'] = $request['address'];
            $data['phone'] = $request['phone'];
            Person::find($id)->update($data);
            $res = Person::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {       
            $res = Person::find($id)->delete(); 
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
      
}