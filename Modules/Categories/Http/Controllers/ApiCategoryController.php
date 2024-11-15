<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponseTrait;
use Illuminate\Routing\Controller;
use Modules\Categories\Entities\Category;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Transformers\CategoryResource;

class ApiCategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return $categories = Category::withTrashed()->paginate($this->pagination);
        return $categories->count() < 1 ?
            $this->failedResponse('there is no categories are added yet', 404) :
            $this->successResponse('all categroies get successfully ', 'categories', CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'slug' => $request->slug,
            'status' => $request->status,
            'en' => [
                'name' => $request->input('en.name'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
                'description' => $request->input('ar.description'),
            ]
        ]);

        return new CategoryResource($category);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
    //    return $routeName = $request->route()->getName(); 
        $category = Category::withTrashed()->findOrFail($id);

        $category->update([
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        foreach (['en', 'ar'] as $locale) {
            if ($request->has($locale)) {
                $category->translateOrNew($locale)->name = $request->input("$locale.name");
                $category->translateOrNew($locale)->description = $request->input("$locale.description");
            }
        }

        $category->save();

        return new CategoryResource($category);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }


    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return response()->json(['message' => 'Category restored successfully']);
    }


    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();
        return response()->json(['message' => 'Category permanently deleted']);
    }
}
