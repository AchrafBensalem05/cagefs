<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{



    public function index($type , ArticleDataTable $articleDataTable)
    {
        return view("back.articles.index"  ,
            [
                "article_datatable"   =>  $articleDataTable->html(),
                'title'                   =>  $type  . "Timeline management" ,
                'type'                    =>  $type
            ]);
    }


    public function get_index($type , ArticleDataTable $articleDataTable)
    {
        return $articleDataTable->render("back.articles.index" );
    }


    public function show($type , Article $article)
    {
        return view('back.articles.delete' , [
            'article' => $article ,
            'title' => "Deleting Article :" . $article->title,
            'type'  => $type
        ]);
    }

    public function destroy($type,Article $article)
    {
        try{
            $article->delete();
            flash("Article of  " . $article->title . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('article.index' , $type);
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
