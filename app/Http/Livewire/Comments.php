<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    //prevents reloading of when moving from page to page 
    use WithPagination;

    public $newComment;

    public function updated($field){
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment() {

        $this->validate(['newComment' => 'required|max:255']);

       
        //create 
        $createdComment = Comment::create(['body' => $this->newComment, 'user_id'=>1]);

        
       
            //empty comment inout form 
        $this->newComment ="" ;
        
        //flash session message
        session()->flash('message', 'Comment added successfully');
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();
        
        session()->flash('message', 'Comment deleted successfully');
    }

    public function mount(){

        //fetch comments from db 
        //get the latest comment
        $initialComments = Comment::latest()->get();
        $this->comments = $initialComments;
    }

    

    
    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
