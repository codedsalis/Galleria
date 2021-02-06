<?php

namespace App\Http\Livewire\Webstore\ControlPanel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductCategory;
use App\Library\Galleria;

class ProductCategories extends Component
{
    /**
     * Confirms category deletion
     */
    public $confirmingCategoryDeletion = false;

    /**
     * Determines whether or not the category is being managed for edition
     */
    public $managingCategory = false;

    /**
     * Specifies the category being managed for edition
     */
    public $managingCategoryFor;

    /**
     * Specifies the category being deleted
     */
    public $categoryIdBeingDeleted;

    /**
     * Specifies whether or not all categories are selected
     */
    public $selectAll = false;

    /**
     * Specifies whether or not bulk selection is enabled
     */
    public $bulkDisabled = true;

    /**
     * Holds the selected categories for deletion
     */
    public $selectedCategories = [];

    /**
     * This current Webstore ID
     */
    public $webstoreId;

    /**
     * The name of the new category being created
     */
    public $name;

    /**
     * The description of the new category being created
     */
    public $description;

    /**
     * The (new)name of the category to be updated
     */
    public $nameUpdate;

    /**
     * The (new)description of the category to be updated
     */
    public $descriptionUpdate;


    use WithPagination;


    protected $rules = [
        'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]*$/']
    ];


    public function mount() {
        $this->selectedCategories = collect();
    }


    public function manageCategory($categoryId) {
        $this->managingCategory = true;
        
        $category = ProductCategory::findOrFail($categoryId);

        $this->managingCategoryFor = $category->id;

        $this->nameUpdate = $category->name;
        $this->descriptionUpdate = $category->description;
    }

    /**
     * Update the category with the given values
     */
    public function updateCategory() {
        $this->validate([
            'nameUpdate' => 'required|string',
        ]);

        $category = ProductCategory::findOrFail($this->managingCategoryFor);
        
        $galleria = new Galleria();
        $slug = $galleria->makeSlug($this->nameUpdate, '-', 'product_categories');

        $category->name = $this->nameUpdate;
        $category->description = $this->descriptionUpdate;
        $category->slug = $slug;

        $category->save();

        $this->managingCategory = false;
    }


    public function createCategory($id = NULL) {
        $this->validate();

        $galleria = new Galleria();
        $slug = $galleria->makeSlug($this->name, '-', 'product_categories');
        
        $category = $id ? ProductCategory::findOrFail($id) : new ProductCategory;

        $category->webstore_id = $this->webstoreId;
        $category->name = $this->name;
        $category->slug = $slug;
        $category->description = $this->description;

        if ($category->save()) {
            //Clear the form 
            $this->name = '';
            $this->description = '';

            // Set a flash message
            session()->flash('categoryCreationMessage', 'Category created');
            
            // Create a browser event
            $this->dispatchBrowserEvent('categoryCreated', ['categories' => $category]);
        }
    }


    public function confirmCategoryDeletion($categoryId) {
        $this->confirmingCategoryDeletion = true;

        $this->categoryIdBeingDeleted = $categoryId;
    }


    public function deleteCategory() {
        ProductCategory::where('id', $this->categoryIdBeingDeleted)->delete();

        $this->confirmingCategoryDeletion = false;
    }


    public function updatedSelectAll($value) {
        if ($value) {
            $this->selectedCategories = ProductCategory::pluck('id');
        }
        else {
            $this->selectedCategories = [];
        }
    }

    public function deleteSelected() {
        ProductCategory::query()
            ->whereIn('id', $this->selectedCategories)
            ->delete();

        $this->selectedCategories = [];
        $this->selectAll = false;
    }


    // /**
    //  * Create a slug by replacing spaces with dashes
    //  * 
    //  * @var String $name
    //  * @return String
    //  */
    // protected function makeSlug(String $name) : String {
    //     // Strip the name of any tags after trimming it
    //     $name = strip_tags(trim($name));

    //     // Replace a comma if any
    //     $name = str_replace(',', '', $name);

    //     // Split into an array using white space as a delimiter
    //     $split = \explode(' ', $name);

    //     // Get the first part of the array and add a 
    //     // dash to it if the array is of larger size than zero
    //     $slug = count($split) > 1 ? strtolower($split[0]) . '-' : strtolower($split[0]);

    //     // Loop through the array for subsequent keys and add dashes 
    //     // as long as the iteration is less than the total size of the 
    //     // array while converting all letters to lower case letters
    //     for ($i = 1; $i < count($split); $i++) {
    //         $slug .=(count($split)-1)==$i ? strtolower($split[$i]) :
    //         strtolower($split[$i]) . '-' ;
    //     }
    //     return $slug;
    // }


    public function render()
    {
        $this->bulkDisabled = count($this->selectedCategories) < 1;

        return view('livewire.webstore.control-panel.product-categories', [
            'categories' => ProductCategory::where('webstore_id', $this->webstoreId)
                            ->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }


}
