<?php

namespace App\Http\Livewire\Webstore;

use Livewire\Component;
use App\Models\Webstore;
use Illuminate\Support\Facades\Validator;


class Essentials extends Component
{
    public $step = 1;
    public Webstore $webstore;
    public $username;
    public $name;
    public $description;
    public $message = "";


    protected $rules = [
        'username' => 'required|alpha_dash|min:2|unique:webstores,url',
        'name' => 'required',
        'description' => 'required',
    ];


    public function updated($username) {
        $this->validateOnly($username);
    }


    public function submitEssentials()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.
        $this->step++;
    }

    public function render()
    {
        return view('livewire.webstore.essentials');
    }
}
