<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competences
 *
 * @ORM\Table(name="Competences", indexes={@ORM\Index(name="FK_Competence_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Competences
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_competence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompetence;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_competence", type="string", length=64, nullable=false)
     */
    private $nomCompetence;

    /**
     * @var boolean
     *
     * @ORM\Column(name="niveau_competence", type="boolean", nullable=false)
     */
    private $niveauCompetence;

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
     * Get idCompetence
     *
     * @return integer
     */
    public function getIdCompetence()
    {
        return $this->idCompetence;
    }

    /**
     * Set nomCompetence
     *
     * @param string $nomCompetence
     * @return Competences
     */
    public function setNomCompetence($nomCompetence)
    {
        $this->nomCompetence = $nomCompetence;

        return $this;
    }

    /**
     * Get nomCompetence
     *
     * @return string
     */
    public function getNomCompetence()
    {
        return $this->nomCompetence;
    }

    /**
     * Set niveauCompetence
     *
     * @param boolean $niveauCompetence
     * @return Competences
     */
    public function setNiveauCompetence($niveauCompetence)
    {
        $this->niveauCompetence = $niveauCompetence;

        return $this;
    }

    /**
     * Get niveauCompetence
     *
     * @return boolean
     */
    public function getNiveauCompetence()
    {
        return $this->niveauCompetence;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Competences
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
     * @return Competences
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
