<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class PostsByCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.posts.by_category', compact('categories'));
    }
}
