<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::orderBy('completed')->get();
        return view('todos.index')->with(['todos' => $todos]);
        // return view('todos.index', compact('todos'));
    }
    public function create() {
        return view('todos.create');
    }
    public function edit(Todo $todo) {
        // $todo = Todo::find($id);
        return view('todos.edit', compact('todo')); //pass $todo to the edit blade php
    }

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

        Todo::create($request->all());
        return redirect()->back()->with('message', 'Todo created successfully');
    }
    public function update(TodoCreateRequest $request, Todo $todo){

        $todo->update(['ti tle' => $request->title]);
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