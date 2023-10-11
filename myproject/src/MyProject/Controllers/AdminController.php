<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comments;

class AdminController extends MainController
{
    public function view()
    {
        $articles = Article::findAll();
        $comment = Comments::findAllComments();

        $this->view->renderHtml('admin/view.php', ['articles' => $articles, 'comment' => $comment]);
    }
}