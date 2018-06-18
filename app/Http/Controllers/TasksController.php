<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use Calendar;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $events = [];
      $userEvents = Auth::user()->tasks()->get();

            foreach ($userEvents as $event) {
                $events[] = Calendar::event(
                    $event->name,
                    true,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => 'tasks/'.$event->id,
	                ]
                );
            }
        $calendar = Calendar::addEvents($events);
        //return $userEvents;
      $user = Auth::user();
      return view('tasks.index', compact('calendar','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('tasks.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $task = new Task();
      $task->name = $request->name;
      $task->description = $request->description;
      $task->start_date = $request->start_date;
      $task->end_date = $request->end_date;
      $task->user_id = Auth::id();
      $task->save();

      return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = Auth::user();
      $task = $user->tasks()->find($id);
      return view('tasks.show', compact('user','task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
