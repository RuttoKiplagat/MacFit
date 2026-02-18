<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);
        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        try{
            $category->save();
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to create category',
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function readAllCategories(){
        try{
            $categories = Category::all();
            return response()->json($categories);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetch categories',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readCategory($id){
            try{
                $category = Category::findOrFail($id);
                return response()->json($category);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetch category',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateCategory(Request $request, $id){
              $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:1000',
        ]);
        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
            try{
                $existingCategory = Category::findOrFail($id);

                $existingCategory->name = $validated['name'];
                $existingCategory->description = $validated['description'];
                $existingCategory->save();
                return response()->json($existingCategory);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to update category',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteCategory($id){
            try{
                $category = Category::findOrFail($id);
                $category->delete();
                return response("Category deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to delete category',
                    'message' => $exception->getMessage()
                ]);
            }
        }
}
