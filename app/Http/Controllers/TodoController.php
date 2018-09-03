<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Task;
use App\User;
use App\Invitation;

class TodoController extends Controller
{
    public function index(){
        if(Auth::user()->is_admin){
            $coworkers = Invitation::where('admin_id', Auth::user()->id)->where('accepted', 1)->get();
            $invitations = Invitation::where('admin_id', Auth::user()->id)->where('accepted', 0)->get();
            $tasks = Task::where('user_id', Auth::user()->id)->orWhere('admin_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $invitations = [];
            $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(4);
            $coworkers = User::where('is_admin', 1)->get();
        }
        return view('index', compact('tasks', 'coworkers', 'invitations'));
    }

    public function store(Request $request){
        if($request->input('task')){
            $task = new Task;
            $task->content = $request->input('task');
            if(Auth::user()->is_admin){
                if($request->input('assignTo') === Auth::user()->id){
                    Auth::user()->tasks()->save($task);
                } elseif($request->input('assignTo') !== null){
                    $task->user_id = $request->input('assignTo');
                    $task->Admin_id = Auth::user()->id;
                    $task->save();
                }
            } else {
                Auth::user()->tasks()->save($task);
            }
        }
        return redirect()->back();
    }

    public function edit($id){
        $task = Task::find($id);
        if(Auth::user()->is_admin){
            $coworkers = Invitation::where('admin_id', Auth::user()->id)->where('accepted', 1)->get();
            $invitations = Invitation::where('admin_id', Auth::user()->id)->where('accepted', 0)->get();
        } else {
            $coworkers = [];
            $invitations = [];
        }
        return view('edit', compact('task', 'coworkers', 'invitations'));
    }

    public function update($id, Request $request){
        if($request->input('task')){
            $task = Task::find($id);
            $task->content = $request->input('task');
            if(isset($task->admin_id)){
                if(Auth::user()->is_admin){
                    if($request->input('assignTo') === Auth::user()->id){
                        Auth::user()->tasks()->save($task);
                    } elseif($request->input('assignTo') !== null){
                        $task->user_id = $request->input('assignTo');
                        $task->Admin_id = Auth::user()->id;
                        $task->save();
                    }
                    return redirect('/');
                } else {
                    return redirect('/');
                }
            }
        }
    }

    public function delete($id){
        $task = Task::findOrFail($id);
        if(isset($task->admin_id)){
            if(Auth::user()->is_admin){
                $task->delete();
                return redirect()->back();
            } else {
                return redirect('/');
            }
        }
    }

    public function updateStatus($id){
        $task = Task::findOrFail($id);
        $task->status = ! $task->status;
        if($this->_authorize($task->user_id)){
            $task->save();
        }
        return redirect()->back();
    }

    public function sendInvitation(Request $request){
        if(intval($request->input('admin') > 0 && !Invitation::where('worker_id', Auth::user()->id)->where('admin_id', $request->input('admin'))->exists())){
            $inv = new Invitation;
            $inv->worker_id = Auth::user()->id;
            $inv->admin_id = intval($request->input('admin'));
            $inv->save();
        }
        return redirect()->back();
    }

    public function acceptInv($id){
        $inv = Invitation::findOrFail($id);
        $inv->accepted = true;
        if($this->_authorize($inv->admin_id)){
            $inv->save();
        }
        return redirect()->back();
    }

    public function denyInv($id){
        $inv = Invitation::findOrFail($id);
        if($this->_authorize($inv->admin_id)){
            $inv->delete();
        }
        return redirect()->back();
    }

    public function deleteWorker($id){
        $inv = Invitation::findOrFail($id);
        if($this->_authorize($inv->admin_id)){
            $inv->delete();
        }
        return redirect()->back();
    }

    protected function _authorize($id){
        return Auth::user()->id = $id ? true : false;
    }
}
