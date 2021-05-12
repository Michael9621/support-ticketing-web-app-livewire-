<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

use Intervention\Image\ImageManagerStatic;



//use Livewire\WithPagination;
use Livewire\WithPagination;

class Comments extends Component
{
    //prevents reloading of when moving from page to page 
    
    use withPagination;
    public $newComment;

    public $image;
    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected',
    ];

    public function handleFileUpload($imageData){
        $this->image = $imageData;
    }

    public function updated($field){
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function addComment() {

        $this->validate(['newComment' => 'required|max:255']);

        $image = $this->storeImage();
        //create 
        $createdComment = Comment::create([
            'body' => $this->newComment, 'user_id'=>1,
            'image' => $image,
            'support_ticket_id' => $this->ticketId
        ]);

        
       
            //empty comment inout form 
            $this->image = "";
        $this->newComment ="" ;
        
        
        //flash session message
        session()->flash('message', 'Comment added successfully');
    }


    public function storeImage(){
        if(!$this->image){
            return null;
        }

        $img =  ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random(). '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        //remove image on delete
        Storage::disk('public')->delete($comment->image);
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
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }
}
