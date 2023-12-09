<div>
    
        @foreach ($messages as $message)
            <p> {{ $message->content }}</p>
        @endforeach
        <input type="text" wire:model="message" placeholder="Type a message..." />
        <button wire:click="sendMessage">Send</button>
        @livewireScripts
</div>
<div class=""></div>

