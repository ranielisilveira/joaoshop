<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $length = $request->length ?? 10;
        return Category::paginate($length);
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create(
                $request->only(['name'])
            );

            return response()->json([
                'message' => 'Categoria criada com sucesso.',
                'category' => $category,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Category $category)
    {
        return $category->first();
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update(
                $request->only(['name'])
            );

            return response()->json([
                'message' => 'Categoria alterada com sucesso.',
                'category' => $category,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Categoria excluída com sucesso.',
        ]);
    }
}
