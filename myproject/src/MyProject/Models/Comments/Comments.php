<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Comments extends ActiveRecordEntity
{
    protected $userId;
    protected $articleId;

    protected $text;
    protected $createdAt;
    protected $nickname;

    protected $avatarPath;

    public static function addComment(array $fields, User $user, $articleId): Comments
    {
        $comment = new Comments();

        $comment->setText($fields['text']);
        $comment->setAuthor($user);
        $comment->setArticleId($articleId);

        $comment->save();

        return $comment;
    }

    public static function getByArticleId(int $articleId)
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT comments.*, users.nickname, users.avatar_path FROM `' . static::getTableName() . '` LEFT JOIN `' . User::getTableName()
            . '` ON comments.user_id = users.id WHERE article_id = :id;',
            [':id' => $articleId], static::class
        );
        return $entities;
    }

    public function updateFromArray(array $fields): Comments
    {
        $this->setText($fields['text']);
        $this->save();

        return $this;
    }

    public static function findAllComments()
    {
        $db = Db::getInstance();
        return $db->query('SELECT comments.*, users.nickname FROM `' . static::getTableName() . '` LEFT JOIN `' . User::getTableName()
            . '` ON comments.user_id = users.id;', [], static::class);
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getText()
    {
        return $this->text;
    }


    public function getAvatarPath()
    {
        return $this->avatarPath;
    }


    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }

    public function setArticleId($articleId): void
    {
        $this->articleId = $articleId;
    }

    public function getAuthor()
    {
        return User::getById($this->userId);
    }

    public function setAuthor(User $author): void
    {
        $this->userId = $author->getId();
    }

    public static function getTableName(): string
    {
        return 'comments';
    }
}