<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ProductImageController extends Controller
{
    public function store(ProductImageRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->product_id);
            $files = $product->images->count();

            if ($files >= 3) {
                throw new Exception("Não é possível cadastrar mais de 3 imagens para o produto.");
            }

            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $k => $file) {
                    if ($k + $files >= 3) {
                        continue;
                    }

                    $name = time() . '_' . Str::random(10) .  '.' . $file->extension();
                    $file->move(public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR, $name);
                    $product->images()->create(['file' => $name]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Imagens adicionadas ao Produto com sucesso.',
                'product' => $product->refresh(),
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {
        $product_image = ProductImage::findOrFail($id);
        unlink(public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $product_image->file);
        $product_image->delete();

        return response()->json([
            'message' => 'Imagem excluída com sucesso.',
        ]);
    }
}
