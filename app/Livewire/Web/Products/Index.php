<?php

namespace App\Livewire\Web\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $products = Product::query()
            ->where('category_id', 'ratings.customer')
            ->withAvg('ratings', 'rating')
            ->when(request()->has('search'), function ($query) {
                $query->where('title', 'like', '%' . request()->search . '%');
            })
            ->simplePaginate(5);

        return view('livewire.web.products.index', compact('products'));
    }
}
