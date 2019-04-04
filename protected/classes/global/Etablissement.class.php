<?php

/**
 * Class Etablissement
 */
class Etablissement
{


    /**
     * @var Int|null
     */
    private $id;

    /**
     * @var null|String
     */
    private $intitule;

    /**
     * @var null|String
     */
    private $adresse;


    /**
     * Etablissement constructor.
     * @param Int|null $id
     * @param null|String $intitule
     * @param null|String $adresse
     */
    public function __construct(?Int $id, ?String $intitule, ?String $adresse)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->adresse = $adresse;
    }

    /**
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->id;
    }

    /**
     * @param Int|null $id
     */
    public function setId(?Int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|String
     */
    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    /**
     * @param null|String $intitule
     */
    public function setIntitule(?String $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return null|String
     */
    public function getAdresse(): ?String
    {
        return $this->adresse;
    }

    /**
     * @param null|String $adresse
     */
    public function setAdresse(?String $adresse): void
    {
        $this->adresse = $adresse;
    }

}