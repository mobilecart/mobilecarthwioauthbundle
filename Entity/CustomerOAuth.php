<?php

namespace MobileCart\HWIOAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerOAuth
 *
 * @ORM\Table(name="customer_oauth")
 * @ORM\Entity(repositoryClass="MobileCart\HWIOAuthBundle\Repository\CustomerOAuthRepository")
 */
class CustomerOAuth
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
     * @var \MobileCart\CoreBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="MobileCart\CoreBundle\Entity\Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type", type="string", length=32)
     */
    private $account_type;

    /**
     * @var int
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;


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
     * Set customer
     *
     * @param Customer $customer
     * @return CustomerOAuth
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set account_type
     *
     * @param string $account_type
     * @return CustomerOAuth
     */
    public function setAccountType($account_type)
    {
        $this->account_type = $account_type;

        return $this;
    }

    /**
     * Get account_type
     *
     * @return string 
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return CustomerOAuth
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return CustomerOAuth
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
