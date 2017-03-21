<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 18.03.2017
 * Time: 5:33
 */

namespace Corp\Repositories;


use Corp\Comment;

class CommentsRepository extends Repository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}