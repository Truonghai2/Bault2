<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chat extends Component
{

    public $message = '';
    public $requested_id;
    

    public function mount($requested_id)
    {
        $this->requested_id = $requested_id;
    }
    protected $listeners = ['messageSent' => 'refreshMessages'];
    public function render()
    {
        $requester_id = Auth::user()->id;
        $requested_id = $this->requested_id;
        if ($this->requested_id) {
            $requested_id = $this->requested_id;

            $messages = DB::table('messege')->whereIn('status', [0, 1])
                ->where(function ($query) use ($requester_id, $requested_id) {
                    $query->where('requester_id', $requester_id)
                        ->where('requested_id', $requested_id);
                })
                ->orWhere(function ($query) use ($requester_id, $requested_id) {
                    $query->where('requester_id', $requested_id)
                        ->where('requested_id', $requester_id);
                })
                ->get();

            return view('livewire.chat', compact('messages'));
        }

    
        return view('livewire.chat', ['messages' => []]);
    }
    
    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'requester_id' => Auth::user()->id,
            'requested_id' =>$this->requested_id,
            'content' => $this->message,
        ]);

        $this->message = '';
        $this->emit('messageSent');
    }
    public function refreshMessages()
    {
        // Cập nhật lại danh sách tin nhắn khi có sự kiện messageSent được kích hoạt
        $requester_id = Auth::user()->id;

        if ($this->requested_id) {
            $requested_id = $this->requested_id;

            $messages = DB::table('messages')->whereIn('status', [0, 1])
                ->where(function ($query) use ($requester_id, $requested_id) {
                    $query->where('requester_id', $requester_id)
                        ->where('requested_id', $requested_id);
                })
                ->orWhere(function ($query) use ($requester_id, $requested_id) {
                    $query->where('requester_id', $requested_id)
                        ->where('requested_id', $requester_id);
                })
                ->get();

            $this->emit('messageSent',$messages); // Kích hoạt sự kiện để cập nhật tin nhắn realtime
        }
    }
}
