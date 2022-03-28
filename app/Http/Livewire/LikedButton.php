<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikedButton extends Component
{
    private $post;
    public $post_id;
    public $isLiked;
    public $likeCount;
    // mount is like useEffect when the page load it will work 
    public function mount($post_id){
        $this->post = Post::find($post_id);
        if($this->post != null && auth()->user() != null){
            $this->post->likedByUser(auth()->user()) ? $this->isLiked = true : $this->isLiked = false;
        }
        $this->likeCount = $this->post->likedByUsers->count();
    }
    public function ToggleLike($post_id){
        $this->post = Post::find($post_id);
        if($this->post != null && auth()->user() != null){
            // $this->post->likeSystem(auth()->user());
            // it works the same and toggle came from laravel built in methods
            $this->post->likedByUsers()->toggle(auth()->user());
            $this->post->likedByUser(auth()->user()) ? $this->isLiked = true : $this->isLiked = false;
 
        }else{
            return redirect(route('login'));
        }
        $this->likeCount = $this->post->likedByUsers->count();
    }
    public function render()
    {
        return view('livewire.liked-button');
    }
}
