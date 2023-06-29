<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;

class TypeController extends Controller
{
    public function show(Type $type)
    {
        $products = Product::join('warehouses', 'warehouses.id', 'products.warehouse_id')
            ->select('products.*')
            ->where('warehouses.type_id', $type->id)
            ->search('products.name')
            ->latest('products.created_at')
            ->paginate(6)
            ->withQueryString();

        $types = Type::latest()
            ->get();

        return view('landing.type.show', compact('products', 'type', 'types'));
    }
}
