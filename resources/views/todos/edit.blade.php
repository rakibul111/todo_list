@extends('todos.layout')
            <!-- $todo obj available -->

@section('content')    
    <div class="flex justify-between border-b p-3">
        <!-- Header -->
        <h1 class="text-2xl">Update this To-Do</h1>

        <!-- Back button -->
        <a href="{{route('todo.index')}}" class="mx-5 py-2 text-gray-400 text-base cursor-pointer">
            <span class="fas fa-arrow-left"></span>
        </a>
    </div>

    <!-- showing success/error message (component) -->
    <x-alert />

    <form action="{{route('todo.update', $todo->id)}}" method="post" class="py-5">
        @csrf
        @method('patch')
        <div class="py-1">
            <input type="text" name="title" value="{{$todo->title}}" class="p-2 border rounded">
        </div>
        
        <div class="py-1">
            <textarea name="description" class="p-2 border rounded" placeholder="Description">{{$todo->description}}</textarea>
        </div>

        @livewire('edit-step' , ['prev_steps' => $todo->steps])
    
        <div class="py-1">
            <input type="submit" value="Update" class="py-2 px-2 border rounded">
        </div>
    </form>

@endsection
