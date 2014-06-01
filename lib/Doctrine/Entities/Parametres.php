<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametres
 *
 * @ORM\Table(name="Parametres")
 * @ORM\Entity
 */
class Parametres
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_parametre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_parametre", type="string", length=64, nullable=false)
     */
    private $nomParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_parametre", type="string", length=64, nullable=false)
     */
    private $slugParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="description_parametre", type="string", length=256, nullable=false)
     */
    private $descriptionParametre;


    /**
     * Get idParametre
     *
     * @return integer
     */
    public function getIdParametre()
    {
        return $this->idParametre;
    }

    /**
     * Set nomParametre
     *
     * @param string $nomParametre
     * @return Parametres
     */
    public function setNomParametre($nomParametre)
    {
        $this->nomParametre = $nomParametre;

        return $this;
    }

    /**
     * Get nomParametre
     *
     * @return string
     */
    public function getNomParametre()
    {
        return $this->nomParametre;
    }

    /**
     * Set slugParametre
     *
     * @param string $slugParametre
     * @return Parametres
     */
    public function setSlugParametre($slugParametre)
    {
        $this->slugParametre = $slugParametre;

        return $this;
    }

    /**
     * Get slugParametre
     *
     * @return string
     */
    public function getSlugParametre()
    {
        return $this->slugParametre;
    }

    /**
     * Set descriptionParametre
     *
     * @param string $descriptionParametre
     * @return Parametres
     */
    public function setDescriptionParametre($descriptionParametre)
    {
        $this->descriptionParametre = $descriptionParametre;

        return $this;
    }

    /**
     * Get descriptionParametre
     *
     * @return string
     */
    public function getDescriptionParametre()
    {
        return $this->descriptionParametre;
    }
}
