<?php

namespace MyProject\Controllers;

use MyProject\Models\Comments\Comments;

class CommentsController extends AbstractController
{
    public function addComment(int $articleId): void
    {
        if (!empty($_POST)) {
            $comment = Comments::addComment($_POST, $this->user, $articleId);
            header('Location: /articles/' . $articleId, true, 302);
            exit();
        }

        $this->view->renderHtml('articles/view.php');
    }

    public function editComment(int $commentId): void
    {
        $comment = Comments::getById($commentId);

        if(!empty($_POST)) {
            $comment->updateFromArray($_POST);

            header('Location: /');
            exit();
        }

        $this->view->renderHtml('comments/edit.php', ['comment' => $comment]);
    }
}