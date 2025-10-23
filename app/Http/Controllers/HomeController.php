<?php

namespace App\Http\Controllers;

use App\Models\Canteen;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

    $query = Product::with('canteen');

    if (!empty($search)) {
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhereHas('canteen', function ($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              });
    }

    $products = $query->get();
    $canteens = Canteen::all();

    return view('home.index', compact('products', 'canteens'));
    }

    public function showCanteen($id)
    {
        $canteen = Canteen::findOrFail($id);
        $products = Product::where('canteen_id', $id)->get();
        $canteens = Canteen::all();

        return view('home.index', compact('products', 'canteens', 'canteen'));
    }

}
