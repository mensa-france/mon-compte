<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langues
 *
 * @ORM\Table(name="Langues", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Langues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_langue", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_langue", type="string", length=64, nullable=false)
     */
    private $nomLangue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="niveau_langue", type="boolean", nullable=false)
     */
    private $niveauLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

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
     * Get idLangue
     *
     * @return integer
     */
    public function getIdLangue()
    {
        return $this->idLangue;
    }

    /**
     * Set nomLangue
     *
     * @param string $nomLangue
     * @return Langues
     */
    public function setNomLangue($nomLangue)
    {
        $this->nomLangue = $nomLangue;

        return $this;
    }

    /**
     * Get nomLangue
     *
     * @return string
     */
    public function getNomLangue()
    {
        return $this->nomLangue;
    }

    /**
     * Set niveauLangue
     *
     * @param boolean $niveauLangue
     * @return Langues
     */
    public function setNiveauLangue($niveauLangue)
    {
        $this->niveauLangue = $niveauLangue;

        return $this;
    }

    /**
     * Get niveauLangue
     *
     * @return boolean
     */
    public function getNiveauLangue()
    {
        return $this->niveauLangue;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Langues
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set idMembre
     *
     * @param \Membres $idMembre
     * @return Langues
     */
    public function setIdMembre(\Membres $idMembre = null)
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
