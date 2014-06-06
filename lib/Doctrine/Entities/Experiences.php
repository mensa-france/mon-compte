<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experiences
 *
 * @ORM\Table(name="Experiences", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Experiences
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_experience", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_experience", type="string", length=64, nullable=false)
     */
    private $titreExperience;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_organisation", type="string", length=128, nullable=false)
     */
    private $nomOrganisation;

    /**
     * @var string
     *
     * @ORM\Column(name="precisions", type="text", nullable=false)
     */
    private $precisions;

    /**
     * @var \Membres
     *
     * @ORM\ManyToOne(targetEntity="Membres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id_membre")
     * })
     */
    private $idMembre;


    /**
     * Get idExperience
     *
     * @return integer
     */
    public function getIdExperience()
    {
        return $this->idExperience;
    }

    /**
     * Set titreExperience
     *
     * @param string $titreExperience
     * @return Experiences
     */
    public function setTitreExperience($titreExperience)
    {
        $this->titreExperience = $titreExperience;

        return $this;
    }

    /**
     * Get titreExperience
     *
     * @return string
     */
    public function getTitreExperience()
    {
        return $this->titreExperience;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Experiences
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Experiences
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nomOrganisation
     *
     * @param string $nomOrganisation
     * @return Experiences
     */
    public function setNomOrganisation($nomOrganisation)
    {
        $this->nomOrganisation = $nomOrganisation;

        return $this;
    }

    /**
     * Get nomOrganisation
     *
     * @return string
     */
    public function getNomOrganisation()
    {
        return $this->nomOrganisation;
    }

    /**
     * Set precisions
     *
     * @param string $precisions
     * @return Experiences
     */
    public function setPrecisions($precisions)
    {
        $this->precisions = $precisions;

        return $this;
    }

    /**
     * Get precisions
     *
     * @return string
     */
    public function getPrecisions()
    {
        return $this->precisions;
    }

    /**
     * Set idMembre
     *
     * @param \Membres $idMembre
     * @return Experiences
     */
    public function setIdMembre(Membres $idMembre = null)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Get idMembre
     *
     * @return \Membres
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }
}
