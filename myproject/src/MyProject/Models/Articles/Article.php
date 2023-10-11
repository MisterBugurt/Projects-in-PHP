<?php

namespace MyProject\Models\Articles;

use http\Exception\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name;

    protected $text;
    protected $authorId;
    protected $createdAt;


    public static function createFromArray(array $fields, User $user): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Текст статьи не заполнен');
        }

        $article = new Article();

        $article->setName($fields['name']);
        $article->setText($fields['text']);
        $article->setAuthor($user);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }

    public static function getTableName(): string
    {
        return 'articles';
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }


    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }
    public function getText()
    {
        return $this->text;
    }

    public function getAuthor()
    {
        return User::getById($this->authorId);
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getName()
    {
        return $this->name;
    }
}