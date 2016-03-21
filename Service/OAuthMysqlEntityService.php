<?php

namespace MobileCart\HWIOAuthBundle\Service;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use MobileCart\CoreBundle\Constants\EntityConstants;
use MobileCart\HWIOAuthBundle\Constants\EntityConstants as OAuthEntityConstants;
use MobileCart\CoreBundle\Service\MysqlEntityService;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

class OAuthMysqlEntityService
    extends MysqlEntityService
    implements UserProviderInterface, OAuthAwareUserProviderInterface
{

    /**
     * @param UserResponseInterface $response
     * @return mixed|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $email = $response->getEmail();
        $username = $response->getUsername();
        $firstName = $response->getFirstName();
        $lastName = $response->getLastName();
        $accountType = $response->getResourceOwner()->getName();
        $customer = null;

        if ($email) {

            $customer = $this->findOneBy(EntityConstants::CUSTOMER, [
                'email' => $email,
            ]);

            if (!$customer) {

                $customerOauth = $this->findOneBy(OAuthEntityConstants::CUSTOMER_OAUTH, [
                    'account_type' => $accountType,
                    'email' => $username,
                ]);

                if ($customerOauth) {
                    $customer = $customerOauth->getCustomer();
                }
            }

        } else {

            $customerOauth = $this->findOneBy(OAuthEntityConstants::CUSTOMER_OAUTH, [
                'account_type' => $accountType,
                'username' => $username,
            ]);

            if ($customerOauth) {
                $customer = $customerOauth->getCustomer();
            }
        }

        if ($customer) {
            return $customer;
        }

        $customer = $this->getInstance(EntityConstants::CUSTOMER);
        $customerOauth = $this->getInstance(OAuthEntityConstants::CUSTOMER_OAUTH);

        if (!$email) {
            $email = "{$username}@{$accountType}.com";
        }

        $varSet = $this->findOneBy(EntityConstants::ITEM_VAR_SET, [
            'object_type' => EntityConstants::CUSTOMER,
        ]);

        $customer->setItemVarSet($varSet)
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setHash('')
            ->setIsEnabled(1);

        $this->persist($customer);

        $customerOauth->setCustomer($customer)
            ->setAccountType($accountType)
            ->setUsername($username)
            ->setEmail($email);

        $this->persist($customerOauth);

        return $customer;
    }

}
