<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webstore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebstoreController extends Controller
{
    //create a new webstore
    public function new () {
        return view('pages.webstore.create');
    }


    public function webstore($webstore) {
        // $reserved = [
        //     'dashboard',
        //     'register',
        //     'login',
        // ];

        // if(in_array($webstore, $reserved)) {
        //     header("location: http://localhost:8000/i/$webstore");
        //     exit;
        // }

        $get = Webstore::where('url', $webstore)->get();
        echo $get;
    }


    /**
     * The set up page to help the user finish setting up his webstore
     * 
     */
    public function setup($url) {
        $findUrl = Webstore::where('url', $url)
            ->get();

        if(count($findUrl) > 0 && $findUrl[0]->user_id == Auth::id()) {
            return view('pages.webstore.setup')->with('webstore', $findUrl);
        } else {
            \abort(404);
        }
    }


    /**
     * Control panel for logged in webstore owner
     */
    public function controlPanel($webstore) {

        // Check if the webstore url exists
        $findStore = DB::table('webstores')
            ->select('*')
            ->where('url', '=', $webstore)
            ->get();
        
        // If it does and the logged in user is the owner, allow the request
        if(count($findStore) > 0 && $findStore[0]->user_id == Auth::id()) {
            return view('pages.webstore.control-panel.index')->with('webstore', $findStore);
        } else {
        
            // Otherwise return a 404 page
            \abort(404);
        }
    }

    /**
     * Webstore product categories
     */
    public function categories($webstore) {
        // Check if store exist
        $findStore = DB::table('webstores')
        ->select('*')
        ->where('url', '=', $webstore)
        ->get();

        // If it exists and the logged in user is the owner,
        // query for it's categories and return the page
        if(count($findStore) > 0) {
            $findCategory = DB::table('product_categories')
                ->select('*')
                ->where('webstore_id', '=', $webstore)
                ->get();
                
                return view('pages.webstore.control-panel.categories', [
                    'webstore' => $findStore,
                    'categories' => $findCategory,
                    ]);
        }
        else {
            // Return a 404 page if store doesn't exist or it's not the owner
            \abort(404);
        }
    }
}
