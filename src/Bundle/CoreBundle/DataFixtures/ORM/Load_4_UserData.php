<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_4_UserData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $profileSuperAdmin = $this->getReference('profile-super-admin');
        $profilePdvAdmin = $this->getReference('profile-pdv-admin');
		

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setRuc('12345688457');
        $entity->setPassword('123');
        $entity->setName('William');
        $entity->setLastName('Vargas');
        $entity->setEmail('wvargas@' . $this->applicationUrl);
        $entity->setProfile($profileSuperAdmin);
        $manager->persist($entity);
        $this->addReference('user-1', $entity);

        
        $entity = new User();
        $entity->setDni('87654321');
	    $entity->setRuc('87654321111');
        $entity->setPassword('123');
        $entity->setName('Jorge');
        $entity->setLastName('Huamani');
        $entity->setEmail('jhuamani@' . $this->applicationUrl);
        $entity->setProfile($profilePdvAdmin);
        $manager->persist($entity);
        $this->addReference('user-2', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}