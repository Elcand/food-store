<?php

namespace App\Livewire\Web\Checkout;

use App\Models\Province;
use Livewire\Component;

class Index extends Component
{
    public $address;
    public $province_id;
    public $city_id;
    public $disctict_id;

    public function render()
    {
        $provinces = Province::query()->get();

        return view('livewire.web.checkout.index', compact('provinces'));
    }
}
