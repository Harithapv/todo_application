<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = task::all();
        return response()->json(['task'=>$task],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' =>'required'
        ]);

        $task =  new Task;
            $task->task_name    = $request->task_name;
            $task->description  = $request->description;
            $task->status       = $request->status;
            $task->save();

        return response()->json([' message'=>'created successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        $task = Task::where('status',$status)
            ->get();
        if($task) {
            return response()->json(['task' => $task], 200);
        }
        else{
            return response()->json(['message'=>'No matched found'],404);
        }
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

        $task = task::find($id);
        if($task) {
            $task->task_name = $request['task_name'];
            $task->description = $request['description'];
            $task->status = $request['status'];
            $task->update();

            return response()->json(['message' => 'successfully updated'], 200);
        }
        else{
            return response()->json(['message'=>'Id not found'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = task::find($id);
        if($task){
            $task->delete();
            return response()->json(['message'=>'deleted successfully'],200);
        }
        else{
            return response()->json(['message'=>'ID not found'],404);
        }
    }
}
