<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 30/10/2017
 * Time: 00:48
 */

namespace App\Http\Controllers;


use App\Models\Blackboard\Project;
use App\Models\Blackboard\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($project)
    {
        $project = Project::findOrFail($project);
        $tickets = Ticket::search(Input::get('q'))->where('project_id', $project->id)->paginate(3);

        return view('blackboard.tickets.index')
            ->with('project', $project)
            ->with('tickets', $tickets);
    }

    public function show($project, $ticket)
    {
        $project = Project::findOrFail($project);
        $ticket = Ticket::where('id', $ticket)->first();

        $this->checkReadPermission($project, $ticket);
        
        $updates = $ticket->updates()->orderBy('created_at', 'desc')->get();

        return view('blackboard.tickets.show')
            ->with('project', $project)
            ->with('ticket', $ticket)
            ->with('updates', $updates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($project)
    {
        return view('blackboard.tickets.create')
            ->with('project', Project::findOrFail($project));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Project $project, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'content' => 'required'
        ]);

        $ticket = new Ticket();
        $ticket->title = $validated['title'];
        $ticket->priority_id = $validated['priority'];
        $ticket = $project->tickets()->save($ticket);

        $update = new Ticket\Update();
        $update->content = $validated['content'];
        $update->status_id = 1;
        $update->user_id = Auth::user()->id;
        $ticket->updates()->save($update);

        return redirect()->route('projects.tickets.show', [$project->id, $ticket->id]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        if (!$ticket->project()->role()->can_create_ticket)
            abort(403);
        
        return view('blackboard.tickets.edit')
            ->with('ticket', $ticket)
            ->with('project', $ticket->project());
    }

    /**
     * Adds an update to ticket
     *
     * @param  int  $id
     * @return Response
     */
    public function update($project, $ticket, Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'status' => 'integer|required'
        ]);

        $ticket = Ticket::findOrFail($ticket);

        $update = new Ticket\Update();
        $update->status_id = $validated['status'];
        $update->user_id = Auth::user()->id;
        $update->content = $validated['content'];

        $ticket->updates()->save($update);

        return redirect()->route('projects.tickets.show', [$ticket->project()->id, $ticket->id]);

    }

    public function updateTicket($id, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->title = $validated['title'];
        $ticket->save();

        return redirect()->route('projects.tickets.show', [$ticket->project()->id, $ticket->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkReadPermission($project, $ticket = null)
    {
        $role = $project->role();
        
        if (!$role)
            abort(403);
    }

    public function checkWritePermission($project, $ticket = null)
    {
        $role = $project->role();

        if (!$role || $role->can_create_ticket)
            abort(403);
    }

    public function checkUpdatePermission($project, $ticket = null)
    {
        $role = $project->role();

        if (!$role || $role->can_update_ticket)
            abort(403);
    }

    public function checkDeletePermission($project)
    {
        $role = $project->role();

        if (!$role || $role->can_delete_ticket)
            abort(403);
    }

}