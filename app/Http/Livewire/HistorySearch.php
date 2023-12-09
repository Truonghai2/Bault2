<?php

namespace App\Http\Livewire;

use App\Models\history_search;
use App\Models\User;
use Livewire\Component;

class HistorySearch extends Component
{
    public $users;

    public $ousite;

    public function mount(){
         // Retrieve search history for the authenticated user
        $history = history_search::where('user_id', auth()->user()->id)->get();
            
            // Assuming that each search history entry has a 'user_search_id' column
            // and you want to find the corresponding users for each history entry
        $this->users = User::whereIn('id', $history->pluck('user_search_id'))->get();
  
    
    }
    public function delete($id)
    {
        // Delete records from the history_search table
        history_search::where('user_id', auth()->id())->delete();

        // Update the $users variable with the updated data
        $history = history_search::where('user_id', $id)->get();
        $this->users = User::whereIn('id', $history->pluck('user_search_id'))->get();
    }

    public function render()
    {
            
        return view('livewire.history-search');
    }
}
