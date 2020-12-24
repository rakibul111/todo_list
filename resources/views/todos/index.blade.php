@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b p-3">
        <h1 class="text-2xl">All your Todos</h1>

        <!-- Create new button -->
        <a href="{{route('todo.create')}}" class="mx-5 py-2 text-blue-400 cursor-pointer">
            <span class="fas fa-plus-circle"></span>
        </a>
    </div>

    <!-- showing success/error message -->
    <x-alert />
    
    <!-- showing the todos -->
    <ul class="my-5">
        @foreach($todos as $todo)
        <li class="flex justify-between p-2">
            
            <!-- completed or not (mark) -->
            @include('todos.completeButton')

            @if($todo->completed)
                <p class="line-through">{{$todo->title}} </p>
            @else
                <p>{{$todo->title}} </p>
            @endif
            <div>
                <!-- Edit button -->
                <a href="{{route('todo.edit', $todo->id)}}" class="px-1 mx-5 text-yellow-600 rounded cursor-pointer">
                    <span class="fas fa-edit px-2"></span>
                </a>

                <!-- Delete button -->
                 <span class="fas fa-trash px-2 text-red-400 cursor-pointer"
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
        @endforeach
    </ul>
@endsection