<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\UsersAuthService;
use MyProject\View\View;
use MyProject\Services\Db;

class MainController extends AbstractController
{

    public function page(int $pageNum)
    {
        $this->view->renderHtml('main/main.php', [
            'articles' => Article::getPage($pageNum, 5),
            'pagesCount' => Article::getPagesCount(5)
        ]);
    }
    public function main()
    {
        $this->page(1);
    }

}

