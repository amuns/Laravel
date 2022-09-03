<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEditProfileComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $address;
    public $image;
    public $newimage;

    use WithFileUploads;
    public function render()
    {
        return view('livewire.user.user-edit-profile-component')->layout('layouts.base');
    }

    public function mount(){
        $user = User::find(Auth::user()->id);
        $this->name=$user->name;
        $this->email=$user->email;
        $this->mobile=$user->profile->mobile;
        $this->address=$user->profile->address;
        $this->image=$user->profile->image;

    }

    public function updateProfile(){
        $user=User::find(Auth::user()->id);
        $user->name=$this->name;
        $user->save();

        $user->profile->mobile=$this->mobile;
        $user->profile->address=$this->address;
        if($this->newimage){
            if($this->image){
                unlink('assets/images/profile/'.$this->image);
            }
            $imagename=Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('profile', $imagename);
            $user->profile->image=$imagename;
        }
        $user->profile->save();
        session()->flash('message', "Profile Updated Successfully!");
    }
}
