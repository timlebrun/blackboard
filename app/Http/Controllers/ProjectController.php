<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 30/10/2017
 * Time: 00:48
 */

namespace App\Http\Controllers;


use App\Models\Blackboard\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Auth::user()->projects()->get();

        return view('blackboard.projects.index')
            ->with('projects', $projects);
    }

    public function show($project)
    {
        $project = Project::findOrFail($project);
        $tickets = $project->tickets()->orderByDesc('priority_id')->get();

        return view('blackboard.projects.show')
            ->with('project', $project)
            ->with('tickets', $tickets);
    }

    public function create()
    {
        return view('blackboard.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        dd($validated);

        $project = new Project($validated);
        $project->save();

        return redirect()->route('projects.show', [$project->id]);
    }

}