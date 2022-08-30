<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Cart;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    public $search, $product_cat, $product_cat_id, $pagesize;
    
    use WithPagination;
    public function render()
    {
        $products=Product::where('name', 'like', '%'.$this->search .'%')->where('category_id', 'like', '%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        $categories=Category::all();
        return view('livewire.search-component', [
            'products'=>$products,
            'categories'=>$categories
        ])->layout('layouts.base');

    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function mount(){
        $this->pagesize=9;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
    }
}
