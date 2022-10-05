<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class ApplicationComments extends Component
{
    public $comments, $title, $body, $status, $commentId, $search;

    public    $updateMode      = false;
    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];

    public function render()
    {
        $items = Comment::active()->latest()->paginate(20);
        return view('livewire.application-comments',['items' => $items]);
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body  = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        Comment::create($validatedDate);
        session()->flash('message', 'Comment Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $comment          = Comment::findOrFail($id);
        $this->commentId  = $id;
        $this->title      = $comment->title;
        $this->body       = $comment->body;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $comment = Comment::find($this->commentId);
        $comment->update([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Comment Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Comment::find($id)->delete();
        session()->flash('message', 'Deleted Successfully.');
    }
}
