<?php

namespace App\Http\Livewire\Webstore;

use Livewire\Component;
use App\Models\Webstore;
use Illuminate\Support\Facades\Validator;


class AddressAndLocation extends Component
{
    public Webstore $webstore;
    public $step = 2;
    public $username;
    public $name;
    public $description;
    public $state;
    public $city;
    public $category;
    public $address;
    public $message = "";



    // Validation rules
    protected $rules = [
        'state' => ['required', 'min:3', 'regex:/^[a-zA-Z\s]*$/'],
        'city' => ['required', 'regex:/^[a-zA-Z\s]*$/'], // Allow only letters and white space
        'description' => 'required|string',
        'address' => 'required|string'
    ];

    public function submit() {
        $webstore = new Webstore;

        // Validate data
        $this->validate();

        $webstore->user_id = auth()->id();
        $webstore->url = $this->username;
        $webstore->name = $this->name;
        $webstore->description = $this->description;
        $webstore->state = $this->state;
        $webstore->city = $this->city;
        $webstore->address = $this->address;
        $webstore->category = $this->category;

        if($webstore->save()) {
            session()->flash("webstoreCreationMessage", "Webstore creation successful");
            
            // Create a browser event
            $this->dispatchBrowserEvent('webstoreCreated', ['webstoreId' => $webstore->id]);
        }
    }


    public function render()
    {
        return view('livewire.webstore.address-and-location');
    }
}
