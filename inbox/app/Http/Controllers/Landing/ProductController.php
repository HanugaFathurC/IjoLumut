<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['warehouse', 'category'])
            ->search('name')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $types = Type::latest()
            ->get();

        return view('landing.product.index', compact('products', 'types'));
    }

    public function show(Product $product){
        return view('landing.product.show', compact('product'));
    }
}
