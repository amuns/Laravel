<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    public $product_id, $name, $slug, $short_description, $description, $regular_price, $sales_price, $SKU, $stock_status, $featured, $quantity, $image, $category_id, $newimage;
    
    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-edit-product-component',[
            'categories'=>$categories,
        ])->layout('layouts.base');
    }

    public function mount($product_slug){
        $this->product_slug=$product_slug;
        $product=Product::where('slug',$product_slug)->first();
        $this->name=$product->name;
        $this->slug=$product->slug;
        $this->short_description=$product->short_description;
        $this->description=$product->description;
        $this->regular_price=$product->regular_price;
        $this->sales_price=$product->sales_price;
        $this->SKU=$product->SKU;
        $this->stock_status=$product->stock_status;
        $this->featured=$product->featured;
        $this->quantity=$product->quantity;
        $this->image=$product->image;
        $this->product_id=$product->id;
        $this->category_id=$product->category_id;
    }

    public function generateslug(){
        $this->slug=Str::slug($this->name);
    }

    use WithFileUploads;
    public function updateProduct(){
        $product=Product::find($this->product_id);
        $product->name=$this->name;
        $product->slug=$this->slug;
        $product->short_description=$this->short_description;
        $product->description=$this->description;
        $product->regular_price=$this->regular_price;
        $product->sales_price=$this->sales_price;
        $product->SKU=$this->SKU;
        $product->stock_status=$this->stock_status;
        $product->featured=$this->featured;
        $product->quantity=$this->quantity;
        if($this->newimage){
            $imageName='img_'.Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->image->storeAs('products', $imageName);
            $product->image=$imageName;
        }
        $product->category_id=$this->category_id;
        $product->save();
        session()->flash('message', 'Product has been updated Successfully!');
    }
}
