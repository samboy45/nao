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
     * @ORM\Column(name="latitude", type="decimal")
     */
    private $latitude;

    /**
     * @var int
     *
     * @ORM\Column(name="longitude", type="decimal")
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
     * @ORM\ManyToOne(targetEntity="NAO\UserBundle\Entity\User", inversedBy="observations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;


    /**
     * @var
     * @ORM\Column(name="espece_protegeer", type="boolean", )
     */
    private $especeProtegeer;


    /**
     * @var
     * @ORM\Column(name="espece_non_protegeer", type="boolean")
     */
    private $especeNonProtegeer;

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

    /**
     * Set user
     *
     * @param \NAO\UserBundle\Entity\User $user
     *
     * @return Observation
     */
    public function setUser(\NAO\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \NAO\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set especeProtegeer
     *
     * @param boolean $especeProtegeer
     *
     * @return Observation
     */
    public function setEspeceProtegeer($especeProtegeer)
    {
        $this->especeProtegeer = $especeProtegeer;

        return $this;
    }

    /**
     * Get especeProtegeer
     *
     * @return boolean
     */
    public function getEspeceProtegeer()
    {
        return $this->especeProtegeer;
    }

    /**
     * Set especeNonProtegeer
     *
     * @param boolean $especeNonProtegeer
     *
     * @return Observation
     */
    public function setEspeceNonProtegeer($especeNonProtegeer)
    {
        $this->especeNonProtegeer = $especeNonProtegeer;

        return $this;
    }

    /**
     * Get especeNonProtegeer
     *
     * @return boolean
     */
    public function getEspeceNonProtegeer()
    {
        return $this->especeNonProtegeer;
    }
}
