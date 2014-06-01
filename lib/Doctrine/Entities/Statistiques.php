<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistiques
 *
 * @ORM\Table(name="Statistiques", uniqueConstraints={@ORM\UniqueConstraint(name="nom_stat", columns={"nom_stat"})})
 * @ORM\Entity
 */
class Statistiques
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_stat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_stat", type="string", length=64, nullable=false)
     */
    private $nomStat;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur_stat", type="string", length=256, nullable=false)
     */
    private $valeurStat;


    /**
     * Get idStat
     *
     * @return integer
     */
    public function getIdStat()
    {
        return $this->idStat;
    }

    /**
     * Set nomStat
     *
     * @param string $nomStat
     * @return Statistiques
     */
    public function setNomStat($nomStat)
    {
        $this->nomStat = $nomStat;

        return $this;
    }

    /**
     * Get nomStat
     *
     * @return string
     */
    public function getNomStat()
    {
        return $this->nomStat;
    }

    /**
     * Set valeurStat
     *
     * @param string $valeurStat
     * @return Statistiques
     */
    public function setValeurStat($valeurStat)
    {
        $this->valeurStat = $valeurStat;

        return $this;
    }

    /**
     * Get valeurStat
     *
     * @return string
     */
    public function getValeurStat()
    {
        return $this->valeurStat;
    }
}
