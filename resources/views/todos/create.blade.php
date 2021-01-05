@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b p-3">
        <!-- Header -->
        <h1 class="text-2xl">What next you need To-Do</h1>

        <!-- Back button -->
        <a href="{{route('todo.index')}}" class="mx-5 py-2 text-gray-400 text-base cursor-pointer">
            <span class="fas fa-arrow-left"></span>
        </a>
    </div>

    <!-- showing success/error message (component) -->
    <x-alert /> 

    <form action="{{route('todo.store')}}" method="post" class="py-5">
        @csrf
        <div class="py-1">
            <input type="text" name="title" class="p-2 border rounded" placeholder="Title">
        </div>
        
        <div class="py-1">
            <textarea name="description" class="p-2 border rounded" placeholder="Description"></textarea>
        </div>

        <!-- adding step -->
        <div class="py-1">
            @livewire('step')
        </div>

        <!-- Create Button -->
        <div class="py-1">
            <input type="submit" value="Create" class="py-2 px-2 border rounded">
        </div>
    </form>

@endsection
