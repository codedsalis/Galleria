<?php

namespace App\Http\Livewire\Webstore\ControlPanel\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class AddNewItem extends Component
{
    use WithFileUploads;

    /**
     * The Webstore ID for which the item is being added
     */
    public $webstoreId;

    /**
     * All categories created by the particular webstore
     */
    public $categories;

    /**
     * Whether to remain on the page after form submission
     */
    public $stayOnPage = false;

    /**
     * The name of the new product
     */
    public $name;

    /**
     * The price of the new product
     */
    public $price;

    /**
     * The category (ID) of the new product
     */
    public $category;

    /**
     * The description of the new product
     */
    public $description;

    /**
     * Whether the new product is currently in stock/available for order
     */
    public $isInStock;

    /**
     * The discount price of the product if any
     */
    public $discountPrice;

    /**
     * The array of images for the new product
     */
    public $images = [];


    /**
     * Validation rules
     */
    protected $rules = [
        'name' => 'required|string|max:100',
        'description' => 'string|max:512',
        'category' => 'required|numeric|integer',
        'price' => 'required|numeric',
        'discountPrice' => 'numeric',
        'isInStock' => 'required|numeric',
        'images' => 'max:5',
        'images.*' => 'required|image|mimes:png,jpg,gif,jpeg|max:1024',
    ];

    /**
     * Validate $this->images once it is uploaded and before submission
     */
    public function updatedImages() {
        $this->validate([
            'images' => 'max:5',
            'images.*' => 'required|image|mimes:png,jpg,gif,jpeg|max:1024',
        ]);
    }

    /**
     * Set a custom validation message when the selected file is more than the value defined for 'max' and alse when the count of files is greater than the default 5
     */
    protected $messages = [
        'images.max' => 'The maximum number of images to be uploaded is 5, kindly make sure you maintain this limit',
        'images.*.max' => 'A single preview image cannot be more than 1024 kB or 1 MB file size. Please select an image with a smaller file size',
    ];


    public function createProduct() {
        // Validate data
        $this->validate();

        $product = new Product;

        // Define an empty string which will be used to store the file names as a single string later on
        $imageStore = '';

        // Loop through the $this->images array to use them one by one
        for($i= 0; $i < count($this->images); $i++) {
            // Get the original file name
            $fileName = $this->images[$i]->getClientOriginalName();

            // Split file name and the extension to save it with a
            // different name while maintaining the original file extension
            $split = explode('.', $fileName);
            
            // Generate random strings to be used as the file name
            $newFileName = Str::random(32);

            // Store all the file names in a string separated by a comma (,)
            $imageStore .= (count($this->images)-1) == $i ? $newFileName . '.' . strtolower($split[1]) : $newFileName . '.' .
            strtolower($split[1]) . ',';

            // Store as the generated filename in the media disk - storage/app/media/WebstoreID/filename
            $this->images[$i]->storeAs($this->webstoreId, $newFileName . '.' . $split[1], 'media');
        }

        $product->webstore_id = $this->webstoreId;
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price*100; // Store as kobo
        $product->category_id = $this->category;
        $product->is_in_stock = $this->isInStock;
        $product->discount_price = $this->discountPrice*100; // Store as kobo
        $product->images = $imageStore;

        if($product->save()) {
            // Set a flash message
            session()->flash('productItemCreationMessage', 'Product item added');

            // Create a browser event
            $this->dispatchBrowserEvent('productItemCreated', ['webstoreId' => $this->webstoreId]);
        }
    }


    public function render()
    {
        return view('livewire.webstore.control-panel.products.add-new-item');
    }
}
