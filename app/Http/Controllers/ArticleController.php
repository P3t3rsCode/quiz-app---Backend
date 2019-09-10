<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Requests;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get articles
        $articles = Article::paginate(15);
        //return collection as resource
        return ArticleResource::collection($articles);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id):new Article;
        $article->id=$request->input('article_id');
        $article->title=$request->input('title');
        $article->body=$request->input('body');
        
        if($article->save()){
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get Single Article
        $article = Article::findOrFail($id);
        //return article as res
        return new ArticleResource($article);

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get Single Article
        $article = Article::findOrFail($id);
        //return article as res
        if($article->delete())
        return new ArticleResource($article);

    }
}
