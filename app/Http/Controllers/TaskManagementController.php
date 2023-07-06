<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskManagement;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignTaskEmail;


use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    public function addTasks()  {
        
        $userId = Auth::id();

        $task = new TaskManagement();
        $task->user_id = \Request::input('user_id');
        $task->project_id = \Request::input('project_id');
        $task->task_description = \Request::input('task_description');
        $task->start_date = \Request::input('start_date');
        $task->dead_line = \Request::input('dead_line');
        $task->priorites = \Request::input('priorites');
        $task->team_lead_id = $userId;

        $task->save();
        
        $task1 = TaskManagement::
            // select('task_managements.*', 'users.email as user_email', 'projects.project_name')
            // ->join('users', 'users.id', '=', 'task_managements.user_id')
            // ->join('projects', 'projects.id', '=', 'task_managements.project_id')
            where('id', $task->id)
            ->with('team_lead_details')
            ->first();
        print_r($task1);
        exit();
        $mailData = [
            'userName' => $task1->user->name,
            'projectName' => $task->project_name,
            'deadline' => $task->dead_line,
            'email' => $task->user_email,
            'priorities' => $task->priorites,
            'taskDescription' => $task->task_description,
            'teamLeadName' => $task->team_lead_details->name,
            'teamLeadEmail' => $task->team_lead_details->email
        ];
        
        // Send Email
        Mail::to($task->user_email)->send(new AssignTaskEmail($mailData));

        return response()->json(['message' => 'Task added successfully']);
    }


    function getTasks(){
        
        $task = TaskManagement::
        select('task_managements.*','users.*','projects.*','task_managements.id as task_managements_id','task_managements.start_date as task_managements_start_date','task_managements.dead_line as task_managements_dead_line')
        ->join('users','users.id','=','task_managements.user_id')
        ->join('projects','projects.id','=','task_managements.project_id')
        ->with('team_lead_details')
        ->get();

        return response()->json(['task'=>$task]);
    }

    function getTaskById($id){
        $task = TaskManagement::
        select('task_managements.*','users.*','projects.*','task_managements.id as task_managements_id','task_managements.start_date as task_managements_start_date','task_managements.dead_line as task_managements_dead_line')
        ->join('users','users.id','=','task_managements.user_id')
        ->join('projects','projects.id','=','task_managements.project_id')
        ->where('task_managements.id',$id)
        ->with('team_lead_details')
        ->first();

        return response()->json(['task'=>$task]);
    }

    function updateTasks(){
        $id = \Request::input('id');
        $fsf_Assign_to_users = TaskManagement::where('id',$id)
        ->update([
            'user_id' => \Request::input('user_id'),
            'project_id' => \Request::input('project_id'),
            'team_lead_id' => \Request::input('team_lead_id'),
            'task_description' => \Request::input('task_description'),
            'start_date' => \Request::input('start_date'),
            'dead_line' => \Request::input('dead_line'),
            'status' => \Request::input('status'),
            'priorites' => \Request::input('priorities')
        ]);
        
        return response()->json(['message'=>'Update Tasks Successfully']);
    }

    function updateStatusByUserTask(){
 
        $id = \Request::input('id');

        $task = TaskManagement::where('id',$id)
        ->update([
            'status' => \Request::input('status'),
            'comment' => \Request::input('comment')
        ]);
        
        return response()->json(['message'=>'Update Status and comment of task Successfully']);
    }

    function deleteTaskById(){
        
        $id = \Request::input('id');
        $task = TaskManagement::

        where('id',$id)
        ->delete();

        return response()->json(['task'=>'delete fsf Successfully']);
    }

    function getTaskByUserId($userId){
        $task = TaskManagement::
        select('task_managements.*','users.*','projects.*','task_managements.id as task_managements_id','task_managements.start_date as task_managements_start_date','task_managements.dead_line as task_managements_dead_line')
        ->join('users','users.id','=','task_managements.user_id')
        ->join('projects','projects.id','=','task_managements.project_id')
        ->where('user_id',$userId)
        ->with('team_lead_details')
        ->get();

        return response()->json(['task'=>$task]);
    }

    function getTaskByProjectId($projectId){
        $task = TaskManagement::
        select('task_managements.*','users.*','projects.*','task_managements.start_date as task_managements_start_date','task_managements.id as task_managements_id','task_managements.dead_line as task_managements_dead_line')
        ->join('users','users.id','=','task_managements.user_id')
        ->join('projects','projects.id','=','task_managements.project_id')
        ->where('project_id',$projectId)
        ->with('team_lead_details')
        ->get();

        return response()->json(['task'=>$task]);
    }

    function getTaskByUserIdAndProjectId($userId,$projectId){
        $task = TaskManagement::
        select('task_managements.*','users.*','projects.*','task_managements.start_date as task_managements_start_date','task_managements.id as task_managements_id','task_managements.dead_line as task_managements_dead_line')
        ->join('users','users.id','=','task_managements.user_id')
        ->join('projects','projects.id','=','task_managements.project_id')
        ->where('project_id',$projectId)
        ->where('user_id',$userId)
        ->with('team_lead_details')
        ->get();

        return response()->json(['task'=>$task]);
    }
}
