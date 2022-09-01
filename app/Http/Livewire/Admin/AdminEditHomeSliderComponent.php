<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\Component;

class AdminEditHomeSliderComponent extends Component
{
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $slider_id;
    public $newimage;

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component',)->layout('layouts.base');
    }

    public function mount($slider_id){
        $slider=HomeSlider::find($slider_id);
        $this->title=$slider->title;
        $this->subtitle=$slider->subtitle;
        $this->price=$slider->price;
        $this->link=$slider->link;
        $this->image=$slider->image;
        $this->status=$slider->status;
        $this->slider_id=$slider->slider_id;
    }

    public function updateSlider(){
        $slider=HomeSlider::find($this->slider_id);
        $slider->title=$this->title;
        $slider->subtitle=$this->subtitle;
        $slider->price=$this->price;
        $slider->link=$this->link;
        if($this->newimage){
            $imagename=Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->newimage->storeAs('sliders', $imagename);
            $slider->image=$imagename;
        }
        $slider->status=$this->status;
        $slider->slider_id=$this->slider_id;
    }
}
