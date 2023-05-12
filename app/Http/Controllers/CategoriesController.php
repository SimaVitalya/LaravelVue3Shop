<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return response()->json($categories);
    }
//    public function show($id)
//    {
//        $category = Category::where('id', $id)->first();
//        $products = $category ? $category->products : null;
//        return response()->json($products);
//
//
//    }
    public function show($id, Request $request)
    {
        $category = Category::where('id', $id)->first();

        if (!$category) {
            return response()->json(null);
        }

        $query = $category->products();

        if ($request->has('sort')) {
            $sortFields = explode(',', $request->input('sort'));

            foreach ($sortFields as $sortField) {
                $direction = Str::startsWith($sortField, '-') ? 'desc' : 'asc';
                $fieldName = ltrim($sortField, '-');
                $query->orderBy($fieldName, $direction);
            }
        }

        $products = $query->get();
        return response()->json($products);
    }
}
