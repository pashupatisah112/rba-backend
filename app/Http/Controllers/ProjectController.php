<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::with('user')->get();
        return response()->json($project);
    }
    public function store(Request $request)
    {
        $pro = Project::where('title', $request->title)->get();
        if (count($pro) == 0) {
            $project = new Project;
            $project->title = $request->title;
            $project->type = $request->type;
            $project->budget = $request->budget;
            $project->leader = $request->leader;
            $project->user_id=Auth::id();
            $project->save();
            $res=Project::where('id',$project->id)->with('user:id,name')->first();
            return response()->json($res);
        }
        else{
            return response()->json(['status'=>'failed','msg'=>'This project already exists.']);
        }
    }

    public function update(Request $request, $id)
    {
        $pro = Project::where('title', $request->title)->get();
        if (count($pro) == 0) {
            $project = Project::find($id);
            $project->title = $request->title;
            $project->type = $request->type;
            $project->budget = $request->budget;
            $project->leader = $request->leader;
            $project->save();
            $res=Project::where('id',$project->id)->with('user:id,name')->first();
            return response()->json($res);
        }
        else{
            return response()->json(['status'=>'failed','msg'=>'This project already exists.']);
        }
    }

    public function delete($id)
    {
        Project::find($id)->delete();
    }
}
