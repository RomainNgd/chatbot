<?php

namespace App\chat\Entity;

class Produit
{
    private int $id;

    private string $produit;

    private float $prix;

    private string $url;

    private int $ref;

    private Categorie $categorie;

    public function __construct(string $produit, float $prix, string $url, int $ref, Categorie $categorie)
    {
        $this->produit = $produit;
        $this->prix = $prix;
        $this->url = $url;
        $this->categorie = $categorie;
        $this->ref = $ref;
    }

    /**
     * @return string
     */
    public function getProduit(): string
    {
        return $this->produit;
    }

    /**
     * @param string $produit
     */
    public function setProduit(string $produit): void
    {
        $this->produit = $produit;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return Categorie
     */
    public function getCategorie(): Categorie
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @return int
     */
    public function getRef(): int
    {
        return $this->ref;
    }

    /**
     * @param int $ref
     */
    public function setRef(int $ref): void
    {
        $this->ref = $ref;
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
}