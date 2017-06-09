<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObservationRepository")
 */
class Observation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\Date(message="Date invalide")
     * @Assert\NotBlank(message="Veuillez renseigner la date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="latitude", type="float")
     * @Assert\Range(
     *     min=42.3,
     *     max=51.1,
     *     minMessage="Vos coordonnées GPS se situent en dehors du territoire étudié",
     *     maxMessage="Vos coordonnées GPS se situent en dehors du territoire étudié"
     * )
     */
    private $latitude;

    /**
     * @var int
     *
     * @ORM\Column(name="longitude", type="float")
     * @Assert\Range(
     *     min=-5.1,
     *     max=8.3,
     *     minMessage="Vos coordonnées GPS se situent en dehors du territoire étudié",
     *     maxMessage="Vos coordonnées GPS se situent en dehors du territoire étudié"
     * )
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     *@Assert\File(
     *      mimeTypes={"image/png", "image/jpeg", "image/jpg"},
     *      mimeTypesMessage = "La photo doit être au format PNG, JPEG ou JPG",
     *      uploadErrorMessage = "Une erreur est survenue durant le chargement de l'image"
     * )
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Espece")
     * @Assert\NotBlank()
     */
    private $espece;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Observation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     *
     * @return Observation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return int
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param integer $longitude
     *
     * @return Observation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Observation
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Observation
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Observation
     */
    public function setEspece(\AppBundle\Entity\Espece $espece = null)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get espece
     *
     * @return \AppBundle\Entity\Espece
     */
    public function getEspece()
    {
        return $this->espece;
    }
    function __construct()
    {
        $this->date = new \DateTime();
    }
}
