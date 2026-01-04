<?php

namespace App\Models;

class Project
{
    private int $id;
    private string $nom;
    private string $labels;
    private string $img;
    private string $description; // ✅ AJOUT
    private string $dateCreation;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getLabels(): string
    {
        return $this->labels;
    }

    public function setLabels(string $labels): void
    {
        $this->labels = $labels;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    // ✅ GETTER / SETTER DESCRIPTION
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }
}
