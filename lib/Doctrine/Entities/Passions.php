<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Passions
 *
 * @ORM\Table(name="Passions", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Passions implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_passion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPassion;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_passion", type="string", length=64, nullable=false)
     */
    private $nomPassion;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveau_passion", type="smallint", nullable=false)
     */
    private $niveauPassion;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var \Membres
     *
     * @ORM\ManyToOne(targetEntity="Membres", inversedBy="passions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id_membre")
     * })
     */
    private $idMembre;


    /**
     * Get idPassion
     *
     * @return integer
     */
    public function getId()
    {
        return $this->idPassion;
    }

    /**
     * Set nomPassion
     *
     * @param string $nomPassion
     * @return Passions
     */
    public function setNom($nomPassion)
    {
        $this->nomPassion = $nomPassion;

        return $this;
    }

    /**
     * Get nomPassion
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nomPassion;
    }

    /**
     * Set niveauPassion
     *
     * @param integer $niveauPassion
     * @return Passions
     */
    public function setNiveau($niveauPassion)
    {
		$niveauPassion = min(5,max(0,$niveauPassion));
        $this->niveauPassion = $niveauPassion;

        return $this;
    }

    /**
     * Get niveauPassion
     *
     * @return integer
     */
    public function getNiveau()
    {
        return $this->niveauPassion;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Passions
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
     * @return Passions
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
