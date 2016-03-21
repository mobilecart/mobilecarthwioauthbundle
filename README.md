# mobilecarthwioauthbundle
Mobile Cart OAuth integration with HWI/OAuthBundle

How to Install:

* composer require mobilecart/hwioauthbundle:dev-master
* enable the 2 bundles in app/AppKernel.php :
* new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
* new MobileCart\HWIOAuthBundle\MobileCartHWIOAuthBundle(),
* update/reload Doctrine schema with app/console
* merge/over-write the default Mobile Cart app/config/security.yml with the supplied Resources/config/security.yml
* see the supplied Resources/config/routing.yml and follow the directions regarding what to add and remove
* append the supplied Resources/config/config.yml to your app/config/config.yml and add your account details
