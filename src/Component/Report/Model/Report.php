<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 */
class Report
{

    /**
     * @var integer
     */

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="IDENTITY")
//     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $userCreate;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $userUpdate;

    /**
     * @var boolean
     */
    private $isActive = '1';


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
     * Set code
     *
     * @param string $code
     *
     * @return Report
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Report
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Report
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Report
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Report
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Report
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return integer
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Report
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

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Report
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Report
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}

