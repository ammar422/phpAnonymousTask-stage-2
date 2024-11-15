<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponseTrait;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Article\Http\Requests\ArticleRequest;
use Modules\Article\Transformers\ArticleResource;

class ApiArticleController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $articles = Article::withTrashed()->with(['category', 'author'])->paginate($this->pagination);

        return ArticleResource::collection($articles);
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create([
            'category_id' => $request->category_id,
            'author_id' => auth()->id(),
            'slug' => $request->slug,
            'status' => $request->status,
            'en' => [
                'title' => $request->input('en.title'),
                'content' => $request->input('en.content'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
                'content' => $request->input('ar.content'),
            ]
        ]);

        return new ArticleResource($article);
    }

    public function show($id)
    {
        $article = Article::withTrashed()
            ->with(['category', 'author'])
            ->findOrFail($id);
        return new ArticleResource($article);
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::withTrashed()->findOrFail($id);

        $article->update([
            'category_id' => $request->category_id,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        // Update translations
        foreach (['en', 'ar'] as $locale) {
            if ($request->has($locale)) {
                $article->translateOrNew($locale)->title = $request->input("$locale.title");
                $article->translateOrNew($locale)->content = $request->input("$locale.content");
            }
        }

        $article->save();

        return new ArticleResource($article);
    }

    public function destroy($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();
        return response()->json(['message' => 'Article restored successfully']);
    }

    public function forceDelete($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->forceDelete();
        return response()->json(['message' => 'Article permanently deleted']);
    }
}
