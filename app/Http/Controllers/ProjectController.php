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

        $this->checkReadPermission($project);

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
            'name' => 'required|max:255',
            'description' => 'string|nullable',
            'production_url' => 'url|nullable',
            'development_url' => 'url|nullable',
            'github_url' => 'url|nullable',
            'twitter_url' => 'url|nullable',
            'facebook_url' => 'url|nullable',
            'thumbnail_url' => 'url|nullable'
        ]);

        $project = new Project($validated);


        Auth::user()->projects()->withPivot('user_role_id', '1')->save($project);

        return redirect()->route('projects.show', [$project->id]);
    }

    public function checkReadPermission($project)
    {
        $role = $project->role();

        if (!$role)
            abort(403);
    }

}