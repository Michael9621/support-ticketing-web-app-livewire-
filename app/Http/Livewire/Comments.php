<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;

    public $newComment;

    public function updated($field){
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment() {

        $this->validate(['newComment' => 'required|max:255']);

       
        //create 
        $createdComment = Comment::create(['body' => $this->newComment, 'user_id'=>1]);

        //push new comment to array
        $this->comments->prepend($createdComment);
       
        $this->newComment ="" ;
        //comment
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();
        $this->comments = $this->comments->except($commentId);
    }

    public function mount(){

        //fetch comments from db 
        //get the latest comment
        $initialComments = Comment::latest()->get();
        $this->comments = $initialComments;
    }

    

    
    public function render()
    {
        return view('livewire.comments');
    }
}
