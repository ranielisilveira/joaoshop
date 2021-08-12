<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $length = $request->length ?? 10;
        return Product::paginate($length);
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create(
                $request->only([
                    'sku_code',
                    'category_id',
                    'name',
                    'price',
                    'composition',
                    'size',
                    'stock',
                ])
            );

            return response()->json([
                'message' => 'Produto criado com sucesso.',
                'product' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Product $product)
    {
        return $product->with('category')->first();
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update(
                $request->only([
                    'sku_code',
                    'category_id',
                    'name',
                    'price',
                    'composition',
                    'size',
                    'stock',
                ])
            );

            return response()->json([
                'message' => 'Produto alterado com sucesso.',
                'product' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Produto excluído com sucesso.',
        ]);
    }
}
