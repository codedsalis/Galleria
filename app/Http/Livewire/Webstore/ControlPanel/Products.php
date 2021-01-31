<?php

namespace App\Http\Livewire\Webstore\ControlPanel;

use Livewire\Component;

class Products extends Component
{
    /**
     * The webstore ID for which the products are being queried
     */
    public $webstoreId;

    /**
     * The category ID created for the webstore for which its products are being queried
     */
    public $categoryId;


    public function render()
    {
        return view('livewire.webstore.control-panel.products');
    }
}
