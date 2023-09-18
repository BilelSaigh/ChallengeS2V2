<?php

namespace App\Models;

class Setting extends \App\Core\Sql
{
    protected int $id= 0;
    protected String $website_name = "Adebc";       //mettre la valeur GLOBAL NOM DU SITE
    protected String $h1_color;
    protected String $polices;
    protected String $p_color;
    protected String $p_size;
    protected String $btn_color;


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
    public function getH1Color(): string
    {
        return $this->h1_color;
    }

    /**
     * @param String $h1_color
     */
    public function setH1Color(string $h1_color): void
    {
        $this->h1_color = $h1_color;
    }


    /**
     * @return String
     */
    public function getPolices(): string
    {
        return $this->polices;
    }

    /**
     * @param String $polices
     */
    public function setPolices(string $polices): void
    {
        $this->polices = $polices;
    }

    /**
     * @return String
     */
    public function getPColor(): string
    {
        return $this->p_color;
    }

    /**
     * @param String $p_color
     */
    public function setPColor(string $p_color): void
    {
        $this->p_color = $p_color;
    }

    /**
     * @return String
     */
    public function getPSize(): string
    {
        return $this->p_size;
    }

    /**
     * @param String $p_size
     */
    public function setPSize(string $p_size): void
    {
        $this->p_size = $p_size;
    }

    /**
     * @return String
     */
    public function getBtnColor(): string
    {
        return $this->btn_color;
    }

    /**
     * @param String $btn_color
     */
    public function setBtnColor(string $btn_color): void
    {
        $this->btn_color = $btn_color;
    }

    /**
     * @return String
     */
    public function getWebsiteName(): string
    {
        return $this->website_name;
    }

    /**
     * @param String $website_name
     */
    public function setWebsiteName(string $website_name): void
    {
        $this->website_name = $website_name;
    }

}