<?php

namespace App\Http\Livewire\Webstore;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Webstore;

class Setup extends Component
{
    use WithFileUploads;
    public $webstore;
    public $photo;

    protected $rules = [
        'photo' => 'image|mimes:png,jpg,jpeg|max:1024',
    ];


    public function savePhoto() {

        $this->validate();

        // foreach($this->webstore as $store) {
            // Get file name
            $fileName = $this->photo->getClientOriginalName();

            // Split file name and the extension to save it with a 
            // different name while maintaining the original file extension
            $extension = explode('.', $fileName);

            $this->photo->storeAs($this->webstore->id,  'logo.' . $extension[1], 'media');

            // Save the uploaded file name to the database
            $Webstore = Webstore::findOrFail($this->webstore->id);
            $Webstore->logo = $this->webstore->url . '.' . $extension[1];
            
            if($Webstore->save()) {
                session()->flash('logoMessage', 'Logo uploaded successfully');

               $this->dispatchBrowserEvent('logoUploaded', ['webstoreId' => $this->webstore->id]);
            }
        // }

    }


    public function render()
    {
        return view('livewire.webstore.setup');
    }
}
