<div>
    <div class="flex justify-center mb-2">
        <h2 class="text-lg"> Add steps if required </h2>
        <span wire:click="add" class="fas fa-plus-circle text-blue-300 cursor-pointer m-1.5"></span>
    </div>

    <!-- populate input based on $steps var -->
    @foreach( $steps as $step )
      
        <div class="flex justify-center">

            <!-- use wire:model to send value to the component 
                name="step[]" to store the input values as same name -->
            <input type="text" name="step[]" class="px-2 py-1 m-1 border rounded" placeholder="{{'Describe step '.($loop->index + 1)}}" wire:model="steps.{{$loop->index}}" />

            <span class="fas fa-times text-red-400 p-2 cursor-pointer" wire:click="remove({{$loop->index}})"></span>

        </div>
      
    @endforeach
</div>
