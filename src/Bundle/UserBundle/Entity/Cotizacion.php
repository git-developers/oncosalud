<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Cotizacion
 *
 */
class Cotizacion
{
	
	const ROLE_PRODUCT_VIEW = 'ROLE_PRODUCT_VIEW';
	const ROLE_PRODUCT_CREATE = 'ROLE_PRODUCT_CREATE';
	const ROLE_PRODUCT_EDIT = 'ROLE_PRODUCT_EDIT';
	const ROLE_PRODUCT_DELETE = 'ROLE_PRODUCT_DELETE';
	const BARCODE = 99887766;
	
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	
	const SIZERANGE_1821 = "18-21";
	const SIZERANGE_2226 = "22-26";
	const SIZERANGE_2732 = "27-32";
	const SIZERANGE_3336 = "33-36";
	const SIZERANGE_3337 = "33-37";
	const SIZERANGE_3339 = "33-39";
	
	/**
	 * @var integer
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales",
	 *     "orders"
	 * })
	 */
	private $id;
	
	/**
	 * @var string
	 *
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 7,
	 *      minMessage = "Minimo caracteres {{ limit }} para el codigo",
	 *      maxMessage = "Maximo caracteres {{ limit }} para el codigo"
	 * )
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 * })
	 */
	private $code;
	
	/**
	 * @var integer
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "sales",
	 * })
	 *
	 * @Assert\NotBlank(message="Seleccione el genero")
	 */
	private $modalidad;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales",
	 *     "orders"
	 * })
	 */
	private $name;
	
	/**
	 * @var string
	 */
	private $slug;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 * @JMSS\Type("DateTime<'Y-m-d H:i'>")
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
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders"
	 * })
	 */
	private $quantity;
	
	/**
	 * @var \DateTime|null
	 *
	 */
	private $dob;
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	 * @param string $code
	 */
	public function setCode(string $code): void
	{
		$this->code = $code;
	}
	
	/**
	 * @return int
	 */
	public function getModalidad()
	{
		return $this->modalidad;
	}
	
	/**
	 * @param int $modalidad
	 */
	public function setModalidad(int $modalidad)
	{
		$this->modalidad = $modalidad;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}
	
	/**
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}
	
	/**
	 * @param string $slug
	 */
	public function setSlug(string $slug): void
	{
		$this->slug = $slug;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $createdAt
	 */
	public function setCreatedAt(\DateTime $createdAt): void
	{
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return int
	 */
	public function getUserCreate()
	{
		return $this->userCreate;
	}
	
	/**
	 * @param int $userCreate
	 */
	public function setUserCreate(int $userCreate): void
	{
		$this->userCreate = $userCreate;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * @param \DateTime $updatedAt
	 */
	public function setUpdatedAt(\DateTime $updatedAt): void
	{
		$this->updatedAt = $updatedAt;
	}
	
	/**
	 * @return int
	 */
	public function getUserUpdate()
	{
		return $this->userUpdate;
	}
	
	/**
	 * @param int $userUpdate
	 */
	public function setUserUpdate(int $userUpdate): void
	{
		$this->userUpdate = $userUpdate;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive
	 */
	public function setIsActive(bool $isActive): void
	{
		$this->isActive = $isActive;
	}
	
	/**
	 * @return float
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	/**
	 * @param float $quantity
	 */
	public function setQuantity(float $quantity): void
	{
		$this->quantity = $quantity;
	}
	
	/**
	 * @return \DateTime|null
	 */
	public function getDob()
	{
		return $this->dob;
	}
	
	/**
	 * @param \DateTime|null $dob
	 */
	public function setDob(DateTime $dob)
	{
		$this->dob = $dob;
	}
	
	
	
	
}

