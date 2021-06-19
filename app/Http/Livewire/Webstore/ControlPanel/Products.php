<?php

namespace App\Http\Livewire\Webstore\ControlPanel;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    /**
     * The webstore ID for which the products are being queried
     */
    public $webstoreId;

    /**
     * The category ID created for the webstore for which its products are being queried
     */
    public $categoryId;

    /**
     * Determines if the component is ready to load contentClasses
     */
    public $readyToLoad = false;

    /**
     * The number of items to show per page
     */
    public $limit = 10;

    /**
     * Filter by the status of a product
     */
    public $status = NULL;

    /**
     * Search the database for product name
     */
    public $search = NULL;


    /**
     * Change the state of the property $this->readyToLoad to true
     */
    public function loadProducts() {
        $this->readyToLoad = true;
    }

    /**
     * Update $this->limit
     */
    public function updatedLimit($value) {
        if($value) {
            $this->limit = $value;
        }
    }


    // public function mount() {
        // $this->limit = 10;
    // }


    public function render()
    {
        // $this->limit = $this->update
        $products = $this->readyToLoad ? Product::select('*')
            ->where('webstore_id', $this->webstoreId)
            ->paginate($this->limit) : [];

        return view('livewire.webstore.control-panel.products', [
            'products' => $products,
        ]);
    }
}
