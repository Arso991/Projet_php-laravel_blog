<?php

use App\Models\Blog;

if(!function_exists("idsDB")){
    function idsDB(){
        return $ids = Blog::pluck("id");
    }
}
