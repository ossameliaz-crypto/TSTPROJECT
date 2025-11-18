<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product; 

class ProductController extends Controller
{
    // TUGAS SHELFINA: Get All Products (CRUD Read)
    public function index()
    {
        $products = Product::all(); 

        return response()->json($products, 200); 
    }

    // TUGAS KARIN: Update Product (CRUD Update - RBAC)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); 
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404); 
        }

        $product->update($request->all());

        return response()->json(['message' => 'Produk berhasil diperbarui'], 200); 
    }
}
