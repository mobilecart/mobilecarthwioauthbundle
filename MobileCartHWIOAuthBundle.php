<?php

namespace MobileCart\HWIOAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use MobileCart\HWIOAuthBundle\Constants\EntityConstants;

class MobileCartHWIOAuthBundle extends Bundle
{
    public function boot()
    {
        $this->container->get('cart.entity')
            ->addObjectRepository(
                EntityConstants::CUSTOMER_OAUTH,
                $this->container->getParameter('cart.repo.customer_oauth')
            );
    }
}
