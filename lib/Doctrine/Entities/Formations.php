<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formations
 *
 * @ORM\Table(name="Formations", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Formations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_formation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_formation", type="string", length=64, nullable=false)
     */
    private $titreFormation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
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
     * @ORM\Column(name="nom_ecole", type="string", length=128, nullable=false)
     */
    private $nomEcole;

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
     * Get idFormation
     *
     * @return integer
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * Set titreFormation
     *
     * @param string $titreFormation
     * @return Formations
     */
    public function setTitreFormation($titreFormation)
    {
        $this->titreFormation = $titreFormation;

        return $this;
    }

    /**
     * Get titreFormation
     *
     * @return string
     */
    public function getTitreFormation()
    {
        return $this->titreFormation;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Formations
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
     * @return Formations
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
     * Set nomEcole
     *
     * @param string $nomEcole
     * @return Formations
     */
    public function setNomEcole($nomEcole)
    {
        $this->nomEcole = $nomEcole;

        return $this;
    }

    /**
     * Get nomEcole
     *
     * @return string
     */
    public function getNomEcole()
    {
        return $this->nomEcole;
    }

    /**
     * Set precisions
     *
     * @param string $precisions
     * @return Formations
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
     * @return Formations
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
