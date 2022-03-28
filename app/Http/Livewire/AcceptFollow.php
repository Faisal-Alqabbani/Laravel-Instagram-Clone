<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AcceptFollow extends Component
{
    public $profile_id;
    private $user;
    public $status = "accept";
    
    public function mount($profile_id)
    {
        $this->user = User::find($profile_id);
        if($this->user != null && auth()->user() != null){
            auth()->user()->accepted($this->user) ? $this->status = "accept" : $this->status = "accepted";
        }
    }
    public function toggleAccept($profile_id){
        $this->user = User::find($profile_id);
        if(auth()->user() != null && $this->user !=null){
            if(auth()->user()->accepted($this->user)){
                auth()->user()->toggleAccepted($this->user, false);
                $this->status = "accepted";
            }else{
                auth()->user()->toggleAccepted($this->user, true);
                $this->status = "accept";
            }
        }else{
            return redirect(route('login'));
        }
    }
    public function render()
    {
        return view('livewire.accept-follow');
    }
}
