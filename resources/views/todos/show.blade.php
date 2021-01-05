@extends('todos.layout')

@section('content')
    <!-- showing title -->
    <div class="flex justify-between border-b p-3">
        <!-- Header -->
        <h1 class="text-2xl">{{$todo->title}}</h1>

        <!-- Back button -->
        <a href="{{route('todo.index')}}" class="mx-5 py-2 text-gray-400 text-base cursor-pointer">
            <span class="fas fa-arrow-left"></span>
        </a>
    </div>

   <div>
       <div >
        <!-- showing the description -->
       <h3 class="text-lg font-semibold">Description</h3>
           <p> {{$todo->description}} </p>
       </div>

       <!-- showing the steps -->
       @if($todo->steps->count() > 0)
            <div class="py-4">
                    <h3 class="text-lg font-semibold">Steps for this task</h3>
                    <ul>
                        @foreach($todo->steps as $step)
                        <li>{{ $step->name }}</li>
                        @endforeach
                    </ul>
            </div>
       @endif
   </div>
@endsection