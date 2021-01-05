<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Step;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    // Authentication middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        // get the todos for only authenticated user
        // $todos = auth()->user()->todos()->orderBy('completed')->get();

        $todos = auth()->user()->todos->sortBy('completed');
        return view('todos.index')->with(['todos' => $todos]);
        // ===============================================================
        // get data from table todos 
        // $todos = Todo::orderBy('completed')->get();
        // return view('todos.index')->with(['todos' => $todos]);
        // return view('todos.index', compact('todos'));
    }

    // go to the create blade
    public function create() {
        return view('todos.create');
    }

    public function edit(Todo $todo) {
        // $todo = Todo::find($id);
        return view('todos.edit', compact('todo')); //pass $todo to the edit blade php
    }

    // store data in table from create blade
    public function store(TodoCreateRequest $request) {

        // $request->validate([
        //     'title'=> 'required|max:255'
        // ]);
        
        /////////////////////////////////////////////////////////////////
        // $rules=[
        //     'title'=>'required|max:255'
        // ];
        // $messages=[
        //     'title.max'=>'Todo title should not be greater than 255 chars'
        // ];
        // $validator=Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        ////////////////////////////////////////////////////////////////////
        // Create todos table under authenticated user
        // dd( auth()->user()->todos);
        // auth()->user()->todos()->create($request->all());

        // Create todos(insert into table) using User->todos()
        auth()->user()->todos()->create($request->all());
        
        // For adding steps
        // get the last entered todos raw id
        $todo_id = Todo::orderBy('id' , 'desc')->first()->id;
    
        $step_obj = new Step();
        
        // if steps availabe, create steps(insert into table)
        if($request->step){

            foreach($request->step as $step){
                // if step field is null, do nothing continue the loop
                if($step == ''){
                    continue;
                }
                $step_obj->create(['name' => $step, 'todo_id' => $todo_id]);
            }
        }
  
        // Todo::create($request->all());
        return redirect(route('todo.index'))->with('message', 'Todo created successfully');
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    // update todo list from edit.blade.php
    public function update(TodoCreateRequest $request, Todo $todo){
        // update title and description
        $todo->update(['title' => $request->title]);
        $todo->update(['description' => $request->description]);


         // if steps availabe, update steps(update steps table)
         if($request->stepName){
            
            foreach($request->stepName as $index => $step){
                // if step field is null, do nothing continue the loop
                if($step == ''){
                    continue;
                }

                // get the id of steps table from edit-step.blade
                $id = $request->stepId[$index];
                // if the id is not found, create one step in steps table
                if(!$id){
                    $todo->steps()->create(['name' => $step]);
                }
                // if the id is found, update one step in steps table
                else{
                    $step_obj = Step::find($id);
                    $step_obj->update(['name' => $step]);
                }
            }
        }

        return redirect(route('todo.index'))->with('message' , 'Updated!');
    }
    
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return  redirect()->back()->with('message','Task Deleted!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return  redirect()->back()->with('message','Task Marked as completed!');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return  redirect()->back()->with('message','Task Marked as Incompleted!');
    }

}