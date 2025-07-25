<?php

namespace App\Livewire\Web\Category;

use App\Models\Category;
use Livewire\Component;

class Show extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $category = Category::query()
            ->with('products')
            ->where('slug', $this->slug)
            ->firstOrFail();

        return view('livewire.web.category.show', compact('category'));
    }
}
