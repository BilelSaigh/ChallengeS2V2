<?php
namespace App\Models;
use App\Core\Sql;

class Comment extends Sql
{
    protected Int $id = 0;
    protected string $comment;
    protected string $created_at;
    protected ?int $report = 0;
    protected int $article_id;
    protected int $author;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(): void
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function getReport(): ?int
    {
        return $this->report;
    }

    public function setReport(?int $report): void
    {
        $this->report =++$report;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function setArticleId(int $article_id): void
    {
        $this->article_id = $article_id;
    }

    public function getAuthor(): int
    {
        return $this->author;
    }

    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }



}