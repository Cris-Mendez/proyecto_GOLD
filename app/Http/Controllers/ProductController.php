<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Si la petición es AJAX (fetch), respondemos JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
