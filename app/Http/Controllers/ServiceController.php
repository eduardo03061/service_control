<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Exception;

class ServiceController extends Controller
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
        $request->user()->authorizeRoles(['user']);
        $id = $request->user()->id;
         
        $services = Service::where('user_id',$id)->get();

        return view('services.list', compact('services'));
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['user']);
        return view('services.create');
    }

    public function storage(Request $request)
    {
        $request->user()->authorizeRoles(['user']);
        try {
            $service = new Service();
            $service->name = $request->get('name');
            $service->status = $request->get('status'); 
            $service->user_id= $request->user()->id;
            $service->save();
            $mensaje = "Correctamente creado";
            return back()->with('mensaje', $mensaje);

        } catch (Exception $ex) {
            $response['status'] = 500;
            $response['message'] = 'Lo sentimos ocurrió un error por favor intente de nuevo.';
            $response['error'] = $ex->getMessage();

            return response()->json($response, 400);
        }
    }

    public function edit($idService)
    { 
        $service = Service::find($idService);
 
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $idService)
    {
        try {
            $query = Service::find($idService);
            if ($query) {
                $service_data['name'] = $request->name;
                $service_data['status'] = $request->status;

                $query->update($service_data);

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

    public function delete($idService)
    {
        try {
            $query = Service::find($idService);
            
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
