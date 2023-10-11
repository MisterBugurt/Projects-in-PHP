<?php

namespace MyProject\Controllers;


use MyProject\Exception\InvalidArgumentException;
use MyProject\Exception\ForbiddenException;
use MyProject\Exception\NotFoundException;
use MyProject\Exception\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comments;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\Db;
use MyProject\View\View;

class ArticlesController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        $comment = Comments::getByArticleId($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', [
            'articles' => $article, 'user' => $this->user,
            'comment' => $comment
        ]);
    }


    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Для обновления статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('articles/edit.php', ['error' => $exception->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId());
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Для добавления статьи нужно обладать правами администратора');
        }
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('articles/add.php', ['error' => $exception->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/notObject.php', [], 404);
            return;
        }
        $article->delete();

        var_dump($article);
    }
}