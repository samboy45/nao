<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObservationRepository")
 * @Vich\Uploadable()
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="observation_image", fileNameProperty="image", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
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
     * @var string
     *
     * @ORM\Column(name="type_espece", type="string", length=255, nullable=true)
     */
    private $typeEspece;
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
     * Set typeEspece
     *
     * @param string $typeEspece
     *
     * @return Observation
     */
    public function setTypeEspece($typeEspece)
    {
        $this->typeEspece = $typeEspece;

        return $this;
    }

    /**
     * Get typeEspece
     *
     * @return string
     */
    public function getTypeEspece()
    {
        return $this->typeEspece;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Observation
     *
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $image
     *
     * @return Observation
     */
    public function setimage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getimage()
    {
        return $this->image;
    }


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Observation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
