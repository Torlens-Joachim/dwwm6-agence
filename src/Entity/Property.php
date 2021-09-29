<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @UniqueEntity("title")
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank()
     * @Assert\Length(
     *  max=120
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $surface;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     * @Assert\PositiveOrZero
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $rooms;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank
     * @Assert\Length(
     *  max=10
     * )
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=65)
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $transactionType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $groundSize;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfConstruction;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
    private $sell = false;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="property", orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="property", orphanRemoval=true)
     */
    private $appointments;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTransactionType(): ?string
    {
        if ($this->transactionType === true) {
            $transactionType = "A vendre";
        } else {    
            $transactionType = "A louer";
        }
        return $transactionType;
    }

    public function setTransactionType(bool $transactionType): self
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    public function getGroundSize(): ?int
    {
        return $this->groundSize;
    }

    public function setGroundSize(?int $groundSize): self
    {
        $this->groundSize = $groundSize;

        return $this;
    }

    public function getDateOfConstruction(): ?\DateTimeInterface
    {
        return $this->dateOfConstruction;
    }

    public function setDateOfConstruction(?\DateTimeInterface $dateOfConstruction): self
    {
        $this->dateOfConstruction = $dateOfConstruction;

        return $this;
    }

    public function getSell(): ?bool
    {
        return $this->sell;
    }

    public function setSell(bool $sell): self
    {
        $this->sell = $sell;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setProperty($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getProperty() === $this) {
                $appointment->setProperty(null);
            }
        }

        return $this;
    }
}
