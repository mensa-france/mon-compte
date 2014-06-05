<?php

namespace MonCompte\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coordonnees
 *
 * @ORM\Table(name="Coordonnees", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Coordonnees implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_coordonnee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCoordonnee;

    /**
     * @var string
     *
     * @ORM\Column(name="coordonnee", type="text", nullable=false)
     */
    private $coordonnee;

    /**
     * @var string
     *
     * @ORM\Column(name="type_coordonnee", type="string", nullable=false)
     */
    private $typeCoordonnee;

    /**
     * @var string
     *
     * @ORM\Column(name="usage_coordonnee", type="string", nullable=false)
     */
    private $usageCoordonnee = 'pref';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reservee_gestion_asso", type="boolean", nullable=false)
     */
    private $reserveeGestionAsso;

    /**
     * @var \Membres
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Membres", inversedBy="coordonnees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id_membre")
     * })
     */
    private $idMembre;


    /**
     * Set idCoordonnee
     *
     * @param integer $idCoordonnee
     * @return Coordonnees
     */
    public function setIdCoordonnee($idCoordonnee)
    {
        $this->idCoordonnee = $idCoordonnee;

        return $this;
    }

    /**
     * Get idCoordonnee
     *
     * @return integer
     */
    public function getIdCoordonnee()
    {
        return $this->idCoordonnee;
    }

    /**
     * Set coordonnee
     *
     * @param string $coordonnee
     * @return Coordonnees
     */
    public function setCoordonnee($coordonnee)
    {
        $this->coordonnee = $coordonnee;

        return $this;
    }

    /**
     * Get coordonnee
     *
     * @return string
     */
    public function getCoordonnee()
    {
    	if ($this->getTypeCoordonnee() == 'address')
        	return json_decode($this->coordonnee);

        return $this->coordonnee;
    }

    /**
     * Set typeCoordonnee
     *
     * @param string $typeCoordonnee
     * @return Coordonnees
     */
    public function setTypeCoordonnee($typeCoordonnee)
    {
        $this->typeCoordonnee = $typeCoordonnee;

        return $this;
    }

    /**
     * Get typeCoordonnee
     *
     * @return string
     */
    public function getTypeCoordonnee()
    {
        return $this->typeCoordonnee;
    }

    /**
     * Set usageCoordonnee
     *
     * @param string $usageCoordonnee
     * @return Coordonnees
     */
    public function setUsageCoordonnee($usageCoordonnee)
    {
        $this->usageCoordonnee = $usageCoordonnee;

        return $this;
    }

    /**
     * Get usageCoordonnee
     *
     * @return string
     */
    public function getUsageCoordonnee()
    {
        return $this->usageCoordonnee;
    }

    /**
     * Set reserveeGestionAsso
     *
     * @param boolean $reserveeGestionAsso
     * @return Coordonnees
     */
    public function setReserveeGestionAsso($reserveeGestionAsso)
    {
        $this->reserveeGestionAsso = $reserveeGestionAsso;

        return $this;
    }

    /**
     * Get reserveeGestionAsso
     *
     * @return boolean
     */
    public function getReserveeGestionAsso()
    {
        return $this->reserveeGestionAsso;
    }

    /**
     * Set idMembre
     *
     * @param \Membres $idMembre
     * @return Coordonnees
     */
    public function setIdMembre(Membres $idMembre)
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
			'id' => $this->getIdCoordonnee(),
			'type' => $this->getTypeCoordonnee(),
			'coordonnee' => $this->getCoordonnee(),
			'private' => $this->getReserveeGestionAsso(),
			'usage' => $this->getUsageCoordonnee(),
		];
	}
}
