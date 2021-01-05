@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b p-3">
    
        <!-- Header -->
        <h1 class="text-2xl">All your Todos</h1>

        <!-- Create button -->
        <a href="{{route('todo.create')}}" class="mx-5 py-2 text-blue-400 text-lg cursor-pointer">
            <span class="fas fa-plus-circle"></span>
        </a>
    </div>

    <!-- showing success/error message -->
    <x-alert />
    
    <!-- showing the todos -->
    <ul class="my-5">
        @forelse($todos as $todo)
        <li class="flex justify-between p-2">
            
            <!-- completed or not (mark) -->
            @include('todos.completeButton')

            <!-- Todo Title -->
            @if($todo->completed)
                <p class="line-through">{{$todo->title}} </p>
            @else
                <a class="cursor-pointer" href="{{route('todo.show' , $todo->id)}}">{{$todo->title}} </a>
            @endif

            <div>
                <!-- Edit button -->
                <a href="{{route('todo.edit', $todo->id)}}" class="px-1 mx-5 text-yellow-600 rounded cursor-pointer">
                    <span class="fas fa-pen px-2" aria-hidden="true"></span>
                </a>

                <!-- Delete button -->
                 <span class="fas fa-times px-2 text-red-400 cursor-pointer"
                 onclick="event.preventDefault();
                        if(confirm('Are you really want to delete?')){
                            document.getElementById('form-delete-{{$todo->id}}').submit();
                        }">
                </span>
                
                <form style="display:none" id="{{'form-delete-'.$todo->id}}"        action="{{route('todo.destroy', $todo->id)}}" method="post">
                    @csrf
                    @method('delete')
                </form>
                    </div>
                </li>
        
        @empty
            <p>No task available, create one</p>  
        @endforelse
    </ul>
@endsection