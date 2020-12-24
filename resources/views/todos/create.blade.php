@extends('todos.layout')

@section('content')
    <h1 class="text-2xl border-b pb-3">What next you need To-Do</h1>
    
    <x-alert />

    <form action="{{route('todo.store')}}" method="post" class="py-5">
        @csrf
        <input type="text" name="title" class="py-2 px-2 border rounded">
        <input type="submit" value="Create" class="py-2 px-2 border rounded">
    </form>

    <a href="{{route('todo.index')}}" class="py-1 px-1 mx-5 bg-white-400 rounded cursor-pointer border">Back</a>
@endsection
