<?php


namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category,Request $request)
    {
        $topics = $category->topics()->with('user','category')->withOrder($request->order)->paginate(10);

        return view('topics.index', compact('category', 'topics'));
    }
}
