@extends('todos.layout')
            <!-- $todo obj available -->
@section('content')
<h1 class="text-2xl border-b pb-3">Update this To-Do</h1>

    <x-alert />

    <form action="{{route('todo.update', $todo->id)}}" method="post" class="py-5">
        @csrf
        @method('patch')
        <input type="text" name="title" value="{{$todo->title}}" class="py-2 px-2 border rounded">
        <input type="submit" value="Update" class="py-2 px-2 border rounded">
    </form>

    <a href="{{route('todo.index')}}" class="py-1 px-1 mx-5 bg-white-400 rounded cursor-pointer border">Back</a>
@endsection
