<?php
namespace BIS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(
 *  name = "resident"
 * )
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="BIS\CMSBundle\Entity\ResidentRepository")
 */

class Resident {
    public function __construct() {
        $this->created_at = new \DateTime('now');
        $this->clearances = new ArrayCollection();
    }

    public function __toString() {
        return $this->lname . ', ' . $this->fname;
    }

    /**
     * @ORM\Column(
     *  type = "integer"
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(
     *  strategy = "AUTO"
     * )
     */

    protected $id;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 100
     * )
     * @Assert\NotBlank(
     *  message = "The resident's first name should not be left empty."
     * )
     * @Assert\Length(
     *  min = 1,
     *  max = 100,
     *  minMessage = "The resident's first name should be at least {{ limit }} character/s.",
     *  maxMessage = "The resident's first name should not be more than {{ limit }} character/s."
     * )
     */
    protected $fname;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 100
     * )
     * @Assert\NotBlank(
     *  message = "The resident's last name should not be left empty."
     * )
     * @Assert\Length(
     *  min = 1,
     *  max = 100,
     *  minMessage = "The resident's last name should be at least {{ limit }} characters.",
     *  maxMessage = "The resident's last name should not be more than {{ limit }} characters."
     * )
     */
    protected $lname;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 100,
     *  nullable = true
     * )
     * @Assert\Length(
     *  max = 100,
     *  maxMessage = "The resident's middle name should not be more than {{ limit }} characters."
     * )
     */
    protected $mname;

    /**
     * @var
     * @ORM\Column(
     *  type = "string"
     * )
     * @Assert\Choice(
     *  choices = {"m", "f"},
     *  message = "The resident must belong to a valid gender group."
     * )
     */
    protected $gender;

    /**
     * @ORM\Column(
     *  type = "date"
     * )
     * @Assert\Date(
     *  message = "The resident must have a valid birth date."
     * )
     */
    protected $bdate;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 20,
     *  nullable = true
     * )
     * @Assert\Length(
     *  max = 20,
     *  maxMessage = "The resident's phone number must not exceed {{ limit }} characters."
     * )
     */
    protected $phone;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 256
     * )
     * @Assert\NotBlank(
     *  message = "The resident's home address must not be left blank."
     * )
     * @Assert\Length(
     *  max = 256,
     *  maxMessage = "The resident's home address must not exceed {{ limit }} characters."
     * )
     */
    protected $address;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 100
     * )
     * @Assert\NotBlank(
     *  message = "The resident's occupation must not be left blank."
     * )
     * @Assert\Length(
     *  max = 100,
     *  maxMessage = "The resident's occupation must not exceed {{ limit }} characters."
     * )
     */
    protected $occupation;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 100
     * )
     * @Assert\NotBlank(
     *  message = "The resident's sitio must not be left blank."
     * )
     * @Assert\Length(
     *  max = 100,
     *  maxMessage = "The resident's sition must not exceed {{ limit }} characters."
     * )
     */
    protected $sitio;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 255,
     *  nullable = true
     * )
     */
    protected $photo;

    /**
     * @Assert\File(
     *  maxSize = "2M",
     *  mimeTypes = {"image/jpeg", "image/png"},
     *  mimeTypesMessage = "Please upload a valid JPG/PNG file."
     * )
     */
    protected $photo_file;

    private $photo_temp;

    public function getPhotoAbsolutePath() {
        return null === $this->photo
            ? null
            : $this->getPhotoUploadRootDir() . '/' . $this->photo;
    }

    public function getPhotoWebPath() {
        return null === $this->photo
            ? null
            : $this->getPhotoUploadDir() . '/' . $this->photo;
    }

    protected function getPhotoUploadRootDir() {
        $dir = __DIR__ . '/../../../../web/' . $this->getPhotoUploadDir();
        return realpath($dir);
    }

    protected function getPhotoUploadDir() {
        return 'uploads/photos';
    }

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  nullable=true
     * )
     */
    protected $created_at;

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  nullable = true
     * )
     */
    protected $updated_at;

    /**
     * @ORM\OneToMany(
     *  targetEntity = "Clearance",
     *  mappedBy = "resident"
     * )
     */
    protected $clearances;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fname
     *
     * @param string $fname
     * @return Resident
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     * @return Resident
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     * @return Resident
     */
    public function setMname($mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string
     */
    public function getMname()
    {
        return $this->mname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Resident
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set bdate
     *
     * @param \DateTime $bdate
     * @return Resident
     */
    public function setBdate($bdate)
    {
        $this->bdate = $bdate;

        return $this;
    }

    /**
     * Get bdate
     *
     * @return \DateTime
     */
    public function getBdate()
    {
        return $this->bdate;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Resident
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Resident
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     * @return Resident
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set sitio
     *
     * @param string $sitio
     * @return Resident
     */
    public function setSitio($sitio)
    {
        $this->sitio = $sitio;

        return $this;
    }

    /**
     * Get sitio
     *
     * @return string
     */
    public function getSitio()
    {
        return $this->sitio;
    }

    /**
     * Sets photo file
     *
     * @param UploadedFile $photo_file
     */
    public function setPhotoFile(UploadedFile $photo_file = null)
    {
        $this->photo_file = $photo_file;
        if (isset($this->photo)) {
            $this->photo_temp = $this->photo;
            $this->photo = null;
        } else {
            $this->photo = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePhotoUpload() {
        if (null !== $this->getPhotoFile()) {
            // generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->photo = $filename . '.' . $this->getPhotoFile()->getClientOriginalExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getPhotoFile()) {
            return;
        }

        $this->getPhotoFile()->move($this->getPhotoUploadRootDir(), $this->photo);

        if (isset($this->photo_temp)) {
            @unlink($this->getPhotoUploadRootDir() . '/' . $this->photo_temp);
            $this->photo_temp = null;
        }

        $this->photo_file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        $file = $this->getPhotoAbsolutePath();
        if ($file) {
            @unlink($file);
        }
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Get photo file
     *
     * @return UploadedFile
     */
    public function getPhotoFile() {
        return $this->photo_file;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Resident
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getClearances() {
        return $this->clearances->toArray();
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Resident
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps() {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Add clearances
     *
     * @param \BIS\CMSBundle\Entity\Clearance $clearances
     * @return Resident
     */
    public function addClearance(\BIS\CMSBundle\Entity\Clearance $clearances)
    {
        $this->clearances[] = $clearances;

        return $this;
    }

    /**
     * Remove clearances
     *
     * @param \BIS\CMSBundle\Entity\Clearance $clearances
     */
    public function removeClearance(\BIS\CMSBundle\Entity\Clearance $clearances)
    {
        $this->clearances->removeElement($clearances);
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Resident
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }
}
