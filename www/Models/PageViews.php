<?php

namespace App\Models;

use App\Core\Sql;

class PageViews extends Sql
{
    protected int $id = 0;
    protected string $slug;
    protected string $date_inserted;
    private static $instance = null; // Instance du singleton

    private function __construct()
    {
        parent::__construct(); // Appeler le constructeur de la classe parente
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new PageViews();
        }
        return self::$instance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDateInserted(): string
    {
        return $this->date_inserted;
    }

    public function setDateInserted(): void
    {
        $this->date_inserted = date("Y-m-d H:i:s");
    }

    public function getStats(): array
    {
        $stats["byMonth"]= parent::getCountByMonth();
        $stats["byWeek"]= parent::getCountByWeek();
        $stats["byDay"]= parent::getCountByDay();
        return $stats;

    }

}
