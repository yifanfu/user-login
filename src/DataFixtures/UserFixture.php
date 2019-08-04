<?php

namespace App\DataFixtures;

use App\Entity\Contractor;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $employee = (new Employee())
            ->setUsername('iamemployee');
        $employee->setPassword(
            $this->passwordEncoder->encodePassword($employee, 'superSecurePassword')
        );

        $manager->persist($employee);

        $contractor = (new Contractor())
            ->setUsername('iamcontractor');
        $contractor->setPassword(
            $this->passwordEncoder->encodePassword($contractor, 'yetAnotherSecurePassword')
        );

        $manager->persist($contractor);

        $manager->flush();
    }
}
