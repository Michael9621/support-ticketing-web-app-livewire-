<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        [
            'body'=> 'hello test',
            'created_at' => '3 min ago',
            'creator' => 'Mich haio'
        ]
    ];

    public function addComment() {
        array_unshift($this->comments, [
            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'James'
        ]);

        $this->newComment ="" ;
    }

    public $newComment;

    public function render()
    {
        return view('livewire.comments');
    }
}
