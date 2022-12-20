<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserSignature extends Component
{
    use WithFileUploads;

    public $signature;


    public function render()
    {
        $items = auth()->user();
        return view('livewire.user-signature', ['user' => $items]);
    }


    public function store()
    {
        $this->validate([
            'signature' => 'image|max:1024',
        ]);

        $user   = auth()->user();
        $exists = Storage::disk('public')->exists($user->signature_image);

        if ($exists) {
            Storage::disk('public')->delete($user->signature_image);
        }
        $fileName  = Str::random(5) . '_' . $this->signature->getClientOriginalName();
        $signature = $this->signature->storeAs('signature', $fileName, 'public');
        $user->update(['signature_image' => $signature]);
        $this->alert('success', 'Signature added Successfully.',);
    }
}
