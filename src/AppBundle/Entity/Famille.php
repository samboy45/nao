<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Famille
 *
 * @ORM\Table(name="famille")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FamilleRepository")
 */
class Famille
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
     * @ORM\Column(name="nom_famille", type="string", length=255)
     */
    private $nomFamille;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ordre" , inversedBy="familles")
     */
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Espece", mappedBy="famille")
     */
    private $especes;



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
     * Set nomFamille
     *
     * @param string $nomFamille
     *
     * @return Famille
     */
    public function setNomFamille($nomFamille)
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    /**
     * Get nomFamille
     *
     * @return string
     */
    public function getNomFamille()
    {
        return $this->nomFamille;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->especes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set ordre
     *
     * @param \AppBundle\Entity\Ordre $ordre
     *
     * @return Famille
     */
    public function setOrdre(\AppBundle\Entity\Ordre $ordre = null)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return \AppBundle\Entity\Ordre
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Add espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Famille
     */
    public function addEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes[] = $espece;

        return $this;
    }

    /**
     * Remove espece
     *
     * @param \AppBundle\Entity\Espece $espece
     */
    public function removeEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes->removeElement($espece);
    }

    /**
     * Get especes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEspeces()
    {
        return $this->especes;
    }

    public function __toString()
    {
        return $this->nomFamille;

    }
}
