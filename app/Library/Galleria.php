<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;

class Galleria {

    /**
    * Create a slug by replacing spaces with dashes
    *
    * @param String $name
    * @param String $table
    * @param String $column = 'slug'
    * @param String $separator = '-'
    * @return String
    */
    public function makeSlug(String $name, String $separator = '-', String $table = '', String $column = 'slug') :
    String {
        // Strip the name of any tags after trimming it
        $name = strip_tags(trim($name));

        // Replace a comma if any
        $name = str_replace(',', '', $name);

        // Split into an array using white space as a delimiter
        $split = \explode(' ', $name);

        // Get the first part of the array and add a
        // dash to it if the array is of larger size than zero
        $slug = count($split) > 1 ? strtolower($split[0]) . $separator : strtolower($split[0]);

        // Loop through the array for subsequent keys and add dashes
        // as long as the iteration is less than the total size of the
        // array while converting all letters to lower case letters
        for ($i = 1; $i < count($split); $i++) {
            $slug .= (count($split)-1) == $i ? strtolower($split[$i]) : strtolower($split[$i]) . $separator;
        }

        if($table) {
            // Check if the slug already exists in the database to avoid duplication
            $query = DB::table($table)
                ->select($column)
                ->where($column, '=', $slug)
                ->get();
    
                if(count($query) > 0) {
                    $slug .= $separator . time();
                }
        }

        return $slug;
    }
}
