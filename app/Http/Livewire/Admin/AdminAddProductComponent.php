<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    public $name, $slug, $short_description, $description, $regular_price, $sales_price, $SKU, $stock_status, $featured, $quantity, $image, $category_id;

    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-add-product-component',[
            'categories'=>$categories
        ])->layout('layouts.base');
    }

    public function mount(){
        $this->stock_status="In stock";
        $this->featured=0;
    }

    public function generateslug(){
        $this->slug=Str::slug($this->name);
    }

    use WithFileUploads;
    public function storeProduct(){
        $product=new Product();
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
        $imageName='img_'.Carbon::now()->timestamp.'.'.'jpg';
        $this->image->storeAs('products', $imageName);
        $product->image=$imageName;
        $product->category_id=$this->category_id;
        $product->save();
        session()->flash('message', 'Product has been created Successfully!');
    }
}
