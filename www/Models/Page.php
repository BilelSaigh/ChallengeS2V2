<?php

namespace App\Models;

use App\Core\Sql;

class Page extends Sql
{
    protected Int $id = 0;
    protected String $title;
    protected String $slug;
    protected String $description;
    protected Int $status ;
    protected string $content;
    protected string $updated_at;
    protected int $menu;
    protected ?int $category;

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(?int $category): void
    {
        $this->category = $category;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = trim(ucfirst(strtolower($title)));
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(): void
    {
        $this->slug = strtolower(trim(str_replace(' ', '-', preg_replace('/[[:punct:]]/', '', $this->getTitle()))));
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt(): void
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function getMenu(): int
    {
        return $this->menu;
    }

    public function setMenu(int $menu): void
    {
        $this->menu = $menu;
    }


}