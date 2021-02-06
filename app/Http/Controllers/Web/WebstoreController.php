<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webstore;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebstoreController extends Controller
{
    /**
     * Check if the webstore exists and whether the user 
     * requesting to modify contents is the owner, returns bool or array of data
     * 
     * @var int $webstoreId
     * @return bool
     */
    protected function isWebstoreAndOwner(int $webstoreId, bool $data = NULL) {
        // Check if store exist
        if($data) {
            $findStore = Webstore::select('*')
                ->where('id', '=', $webstoreId)
                ->where('user_id', '=', Auth::id())
                ->get();
            if (count($findStore) > 0) {
                return $findStore;
            }
            else {
                return false;
            }
        }
        else {
            $findStore = Webstore::select('id')
                ->where('id', '=', $webstoreId)
                ->where('user_id', '=', Auth::id())
                ->get();
            return count($findStore) > 0 ? true : false;
        }
    }

    //create a new webstore
    public function new () {
        return view('pages.webstore.create');
    }


    public function webstore($webstore) {
        $get = Webstore::where('url', $webstore)->get();
        echo $get;
    }


    /**
     * The set up page to help the user finish setting up his webstore
     * 
     */
    public function setup($webstoreId) {
        $findStore = $this->isWebstoreAndOwner($webstoreId, true);

        if ($findStore) {
            return view('pages.webstore.setup')->with('webstore', $findStore);
        } 
        else {
            \abort(404);
        }
    }


    /**
     * Control panel for logged in webstore owner
     */
    public function controlPanel($webstoreId) {
        $findStore = $this->isWebstoreAndOwner($webstoreId, true);
        
        if($findStore) {
            return view('pages.webstore.control-panel.index')->with('webstore', $findStore);
        }
        else {
            \abort(404);
        }
    }

    /**
     * Webstore product categories
     */
    public function categories($webstoreId) {
        $findStore = $this->isWebstoreAndOwner($webstoreId, true);
        if ($findStore) {
            return view('pages.webstore.control-panel.categories', [
                'webstore' => $findStore,
                // 'categories' => $findCategory,
            ]);
        }
        else {
            \abort(404);
        }
    }


    /**
     * Upload, create, edit, update and delete product items
     */
    public function products($webstoreId, Request $request) {
        $findStore = $this->isWebstoreAndOwner($webstoreId, true);
        if ($findStore) {
            // If the request contains category then let's get products in that category
            if($request->has('category')) {
                $products = Product::where('webstore_id', $findStore[0]->id)
                    ->where('category_id', $request->category)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
            }
            else {
                // Otherwise get all products in the webstore
                $products = Product::where('webstore_id', $findStore[0]->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
            }

            $categories = ProductCategory::where('webstore_id', $findStore[0]->id)
                ->get();

            return view('pages.webstore.control-panel.products', [
                'webstore' => $findStore,
                'categories' => $categories,
                'products' => $products,
                'request' => $request,
            ]);
        }
        else {
            \abort(404);
        }
    }
}
