<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langues
 *
 * @ORM\Table(name="Langues", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Langues implements \JsonSerializable
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
     * @var integer
     *
     * @ORM\Column(name="niveau_langue", type="smallint", nullable=false)
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
     * @ORM\ManyToOne(targetEntity="Membres", inversedBy="langues")
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
    public function getId()
    {
        return $this->idLangue;
    }

    /**
     * Set nomLangue
     *
     * @param string $nomLangue
     * @return Langues
     */
    public function setNom($nomLangue)
    {
        $this->nomLangue = $nomLangue;

        return $this;
    }

    /**
     * Get nomLangue
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nomLangue;
    }

    /**
     * Set niveauLangue
     *
     * @param integer $niveauLangue
     * @return Langues
     */
    public function setNiveau($niveauLangue)
    {
		$niveauLangue = min(5,max(0,$niveauLangue));

        $this->niveauLangue = $niveauLangue;

        return $this;
    }

    /**
     * Get niveauLangue
     *
     * @return integer
     */
    public function getNiveau()
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

	public function jsonSerialize()
	{
		return [
			'id' => $this->getId(),
			'nom' => $this->getNom(),
			'niveau' => $this->getNiveau(),
			'commentaire' => $this->getCommentaires(),
		];
	}
}
