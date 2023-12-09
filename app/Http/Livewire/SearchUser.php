<?php

namespace App\Http\Livewire;

use App\Models\history_search;
use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $search = '';
    
    
    
    public function add($id){
        $check = history_search::where('user_id',auth()->id())->where('user_search_id',$id)->first();
        if(!$check){
            $history = new history_search;
            $history->user_id = auth()->id();
            $history->user_search_id = $id;
            $history->save();

        }

    }
    public function render()
    {
        $users = User::where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%');
        })
        ->whereNotIn('id', [auth()->user()->id])
        ->with(['getRequester','getRequested'])
        ->get();

        return view('livewire.search-user', [
            'users' => $users,
        ]);
    }
}
