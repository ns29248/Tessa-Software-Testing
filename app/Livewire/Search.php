<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $searchTerm = '';

    public function render()
    {

        return view('livewire.search');
    }

    public function search()
    {
        $this->redirectToShop();
        session(['searchTerm' => $this->searchTerm]);

    }

    public function redirectToShop()
    {

        // Redirect to the shop page
        return redirect()->route('shop');

    }

}
