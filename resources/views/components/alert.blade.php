<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    
    @if(session()->has('message'))
        <!-- access session variable -->
        <div class="py-4 px-2 bg-green-300">{{session()->get('message')}}</div>
        <!-- delete session variable -->
        {{session()->forget('message')}}
    @elseif(session()->has('error'))
        <!-- access sessin flash variable -->
        <div class="py-4 px-2 bg-red-300">{{session()->get('error')}}</div>

    @elseif ($errors->any())
        <div class="py-4 px-2 bg-red-300">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
</div>