<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Admin;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard','admin-api');   
    }

    public function index(){
        $data = Project::all();
        if($data){
            return response()->json([
            'message' => 'success',
            'data' => $data ], 201);
        }else{
            return response()->json([
            'message' => 'failed',], 400);
        }
    }
    
    public function store(Request $request){
        try{
            $request->validate([
                'name' => 'required',
            ]);
            $project = Project::create([
                'admin_id' => FacadesAuth::user()->id,
                'name' => $request->name,
                'start_at' => Carbon::now()
            ]);
            $data = Project::where('id', '=', $project->id)->get();
            if($data){
                return response()->json([
                'message' => 'success',
                'data' => $data ], 201);
            }else{
                return response()->json([
                'message' => 'failed',], 400);
            }
        } catch (Exception $error){
            return response()->json([
                'message' => 'failed',], 400);
        }
    }

    public function show($id){
        $data = Project::with('admin')->where('id', $id)->get();
        if($data){
            return response()->json([
            'message' => 'success',
            'data' => $data ], 201);
        }else{
            return response()->json([
            'message' => 'failed',], 400);
        }
    }

    public function update(Request $request, $id){
        try{
            $request->validate([
                'name' => 'required',
            ]);
            $project = Project::findOrFail($id);
            $project->update([
                'admin_id' => FacadesAuth::user()->id,
                'name' => $request->name,
                'start_at' => Carbon::now()
            ]);
            $data = Project::where('id', '=', $project->id)->get();
            if($data){
                return response()->json([
                'message' => 'success',
                'data' => $data ], 201);
            }else{
                return response()->json([
                'message' => 'failed',], 400);
            }
        } catch (Exception $error){
            return response()->json([
                'message' => 'failed',], 400);
        }
    }

    public function destroy($id){
        $project = Project::findOrFail($id);
        $data = $project->delete();
        if($data){
            return response()->json([
            'message' => 'success',
            'data' => $data ], 201);
        }else{
            return response()->json([
            'message' => 'failed',], 400);
        }
    }
}
