<?php
namespace Itworks\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Table(name="persons")
* @ORM\Entity
*/
class Person {
	
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

	/**
	* @ORM\Column(type="string", length=255)
	* @Assert\NotBlank()
	* @Assert\Type(
	*	type="alpha",
	*	message="only letters"
	* )
	*/
	private $name;

	/**
	* @ORM\Column(type="string", length=255)
	* @Assert\NotBlank()
	* @Assert\Choice (
	*	choices = { "male", "female", "other" },
	*	message = "Choose your gender."
	* )
	*/
	public $gender;

	/**
	* @ORM\Column(type="string", length=255)
	* @Assert\NotBlank()
	* @Assert\Type(
	*	type="digit",
	*	message="only digits"
	* )
	*/
	private $phoneNumber;

	/**
	* Get id
	*
	* @return integer
	*/
	public function getId() {
		return $this->id;
	}

	/**
	* Get name
	*
	* @return string
	*/
	public function getName() {
		return $this->name;
	}

	/**
	* Set name
	*
	* @param string $name
	* @return Person
	*/
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	* Get gender
	* 
	* @return gender
	*/
	public function getGender() {
		return $this->gender;
	}

	/**
	* Set gender
	* @param range $gender
	* @return Person
	*/
	public function setGender() {
		$this->gender = $gender;
		return $this;
	}

	/**
	* Get phonenumber
	*
	* @return string
	*/
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	* Set phonenumber
	*
	* @return Person
	* alltså return object
	*/
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}

}