<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    
    @foreach ($convo as $convoItem)
        <p>{{$convoItem['username']}}: {{$convoItem['message']}}</p>
    @endforeach

    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" />
        <button type="submit">send</button>
    </form>
</div>
