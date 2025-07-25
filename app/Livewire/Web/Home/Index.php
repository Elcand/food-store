<?php

namespace App\Livewire\Web\Home;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;

class Index extends Component
{
    public function getPopularProducts()
    {
        return Product::with('category', 'ratings.customer')
            ->withAvg('ratings', 'rating')
            ->having('ratings_avg_rating', '>=', 4)
            ->limit(5)
            ->get();
    }

    public function getLatestProducts()
    {
        return Product::query()
            ->with('category', 'ratings.customer')
            ->withAvg('ratings', 'rating')
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.web.home.index', [
            'sliders'           => Slider::latest()->get(),
            'categories'        => Category::latest()->get(),
            'popularProducts'   => $this->getPopularProducts(),
            'latestProducts'    => $this->getLatestProducts(),
        ]);
    }
}
