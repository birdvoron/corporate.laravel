<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 18.03.2017
 * Time: 2:18
 */

namespace Corp\Repositories;


use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $articles)
    {
            $this->model = $articles;
    }
    public function one($alias,$attr = array()){
       $article = parent::one($alias,$attr);
        //dd($attr);
        if($article && !empty($attr)) {
            
            $article->load('comments');
            $article->comments->load('user');
        }
        return $article;
    }
}