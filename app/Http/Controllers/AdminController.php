<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service;
use Exception;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkStatus');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
 
        
        $users =  User::whereHas('roles', function($q){
            $q->where('role_id', 2);
        })->get();
 

        return view('users.list', compact('users'));
    }

    public function servicesOfUser(Request $request,$idUser)
    {
        $request->user()->authorizeRoles(['admin']);
        
         
        $services = Service::where('user_id',$idUser)->get();

        return view('users.listServices', compact('services'));
    }
  

    public function edit($idUser)
    { 
        $user = User::find($idUser);
 
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $idUser)
    {
        try {
            $query = User::find($idUser);
            if ($query) {
                $user_data['name'] = $request->name;
                $user_data['email'] = $request->email;
                $user_data['status'] = $request->status;
                $user_data['age'] = $request->age;
                $user_data['gender'] = $request->gender;
                $query->update($user_data);

                $mensaje = "Correctamente actualizado";
                return back()->with('mensaje', $mensaje);
            } else {
                $response['status'] = 500;
                $response['message'] = 'Lo sentimos ocurrió un error por favor intente de nuevo.';

                return response()->json($response, 400);
            }
        } catch (Exception $ex) {
            $response['status'] = 500;
            $response['message'] = 'Lo sentimos ocurrió un error por favor intente de nuevo.';
            $response['error'] = $ex->getMessage();

            return response()->json($response, 400);
        }
    }

    public function delete($idUser)
    {
        try {
            $query = User::find($idUser);
            
            $query->delete();

            $mensaje = "Correctamente Eliminado";
            return back()->with('mensaje', $mensaje);
           
        } catch (Exception $ex) {
            $response['status'] = 500;
            $response['message'] = 'Lo sentimos ocurrió un error por favor intente de nuevo.';
            $response['error'] = $ex->getMessage();

            return response()->json($response, 400);
        }
    }
}
