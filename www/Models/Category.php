<?php

namespace App\Models;

use App\Core\Sql;

class Category extends Sql
{
    protected int $id = 0;
    protected int $menu = 0;
    protected String $title;
    protected String $slug;



    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(): void
    {
        $this->slug ="all-".strtolower(trim(str_replace(' ', '-', preg_replace('/[[:punct:]]/', '', $this->getTitle()))));
    }

    public function isMenu(): int
    {
        return $this->menu;
    }

    public function setMenu(int $menu): void
    {
        $this->menu = $menu;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = strtolower(trim($title));
    }


}