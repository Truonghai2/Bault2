<?php

namespace App\Http\Livewire;

use App\Models\CompanySuport;
use App\Models\Friendship as modelFriendship;
use Carbon\Carbon;
use Livewire\Component;

class Friendship extends Component{

    public $friend;
    public $listFriend;
    public $company_suport;
    public function mount()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(7);

        $this->friend = modelFriendship::where(function ($query) {
            $query->where('requested_id', auth()->id());
                
        })
        ->where('status', 'pending')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->with('getRequester')
        ->get();
        $this->listFriend = modelFriendship::where(function ($query) {
            $query->where('requested_id', auth()->id())
                  ->orWhere('requester_id', auth()->id());
            })
            ->where('status', 'accepted')

            ->with(['getRequester', 'getRequested'])
            ->take(20) // Giới hạn kết quả trả về thành 20 người
            ->get();
        $this->company_suport = CompanySuport::get();
    }

    public function render()    
    {
        return view('livewire.friendship');
    }
}
