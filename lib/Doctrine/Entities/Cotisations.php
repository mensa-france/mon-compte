<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cotisations
 *
 * @ORM\Table(name="Cotisations", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Cotisations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cotisation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCotisation;

    /**
     * @var float
     *
     * @ORM\Column(name="id_cotisation_distant", type="float", precision=10, scale=0, nullable=true)
     */
    private $idCotisationDistant;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="string", length=4, nullable=false)
     */
    private $tarif;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=4, nullable=false)
     */
    private $region;

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
     * Get idCotisation
     *
     * @return integer
     */
    public function getIdCotisation()
    {
        return $this->idCotisation;
    }

    /**
     * Set idCotisationDistant
     *
     * @param float $idCotisationDistant
     * @return Cotisations
     */
    public function setIdCotisationDistant($idCotisationDistant)
    {
        $this->idCotisationDistant = $idCotisationDistant;

        return $this;
    }

    /**
     * Get idCotisationDistant
     *
     * @return float
     */
    public function getIdCotisationDistant()
    {
        return $this->idCotisationDistant;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     * @return Cotisations
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Cotisations
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Cotisations
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
     * @return Cotisations
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
     * Set region
     *
     * @param string $region
     * @return Cotisations
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set idMembre
     *
     * @param \Membres $idMembre
     * @return Cotisations
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
