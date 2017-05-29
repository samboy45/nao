<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordre
 *
 * @ORM\Table(name="ordre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdreRepository")
 */
class Ordre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ordre", type="string", length=255)
     */
    private $nomOrdre;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Famille", mappedBy="ordre")
     */
    private $familles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomOrdre
     *
     * @param string $nomOrdre
     *
     * @return Ordre
     */
    public function setNomOrdre($nomOrdre)
    {
        $this->nomOrdre = $nomOrdre;

        return $this;
    }

    /**
     * Get nomOrdre
     *
     * @return string
     */
    public function getNomOrdre()
    {
        return $this->nomOrdre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->familles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add famille
     *
     * @param \AppBundle\Entity\Famille $famille
     *
     * @return Ordre
     */
    public function addFamille(\AppBundle\Entity\Famille $famille)
    {
        $this->familles[] = $famille;

        return $this;
    }

    /**
     * Remove famille
     *
     * @param \AppBundle\Entity\Famille $famille
     */
    public function removeFamille(\AppBundle\Entity\Famille $famille)
    {
        $this->familles->removeElement($famille);
    }

    /**
     * Get familles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamilles()
    {
        return $this->familles;
    }

    public function __toString()
    {
        return $this->nomOrdre;
    }
}
