<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="Configuration", indexes={@ORM\Index(name="id_utilisateur", columns={"id_utilisateur", "id_parametre", "valeur_parametre"}), @ORM\Index(name="id_parametre", columns={"id_parametre"})})
 * @ORM\Entity
 */
class Configuration
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_config", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConfig;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     */
    private $idUtilisateur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_parametre", type="boolean", nullable=false)
     */
    private $idParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur_parametre", type="string", length=256, nullable=false)
     */
    private $valeurParametre;


    /**
     * Get idConfig
     *
     * @return integer
     */
    public function getIdConfig()
    {
        return $this->idConfig;
    }

    /**
     * Set idUtilisateur
     *
     * @param integer $idUtilisateur
     * @return Configuration
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set idParametre
     *
     * @param boolean $idParametre
     * @return Configuration
     */
    public function setIdParametre($idParametre)
    {
        $this->idParametre = $idParametre;

        return $this;
    }

    /**
     * Get idParametre
     *
     * @return boolean
     */
    public function getIdParametre()
    {
        return $this->idParametre;
    }

    /**
     * Set valeurParametre
     *
     * @param string $valeurParametre
     * @return Configuration
     */
    public function setValeurParametre($valeurParametre)
    {
        $this->valeurParametre = $valeurParametre;

        return $this;
    }

    /**
     * Get valeurParametre
     *
     * @return string
     */
    public function getValeurParametre()
    {
        return $this->valeurParametre;
    }
}
