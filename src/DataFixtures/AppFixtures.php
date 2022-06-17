<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $employee = new User;
        $employee->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setEmail($faker->email())
            ->setPhone('0606060606')
            ->setPassword(
                $this->encoder->encodePassword(
                    $employee,
                    'password'
                )
            );
        $manager->persist($employee);

        $employee2 = new User;
        $employee2->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setEmail('admin@test.com')->setRoles(['ROLE_ADMIN'])
            ->setPhone('0606060606')
            ->setPassword(
                $this->encoder->encodePassword(
                    $employee,
                    'motdepasse'
                )
            );
        $manager->persist($employee2);

        for ($i = 0; $i < 10; $i++) {

            $title = $faker->words(3, true);
            $slug = str_replace(" ", "-", $title);
            $property = (new Property)
                ->setTitle($title)
                ->setSurface($faker->numberBetween(35, 230))
                ->setContent($faker->paragraphs(4, true))
                ->setPrice($faker->numberBetween(100000, 1200000))
                ->setFloor($faker->randomDigit())
                ->setRooms($faker->randomDigitNotNull())
                ->setAddress($faker->streetAddress())
                ->setZipcode($faker->postcode())
                ->setImageName($faker->imageUrl($width = 640, $height = 480))
                ->setCity($faker->city())
                ->setType($faker->randomElement(["appartement", "maison", "villa"]))
                ->setTransactionType(true)
                ->setDateOfConstruction(new \DateTime($faker->date()))
                ->setSlug($slug)
                ->setEmployee($employee);
            $manager->persist($property);
        }

        for ($i = 0; $i < 10; $i++) {

            $title = $faker->words(3, true);
            $slug = str_replace(" ", "-", $title);
            $property = (new Property)
                ->setTitle($title)
                ->setSurface($faker->numberBetween(35, 230))
                ->setContent($faker->paragraphs(4, true))
                ->setPrice($faker->numberBetween(250, 1000))
                ->setFloor($faker->randomDigit())
                ->setRooms($faker->randomDigitNotNull())
                ->setAddress($faker->streetAddress())
                ->setZipcode($faker->postcode())
                ->setCity($faker->city())
                ->setType($faker->randomElement(["appartement", "maison", "villa"]))
                ->setTransactionType(false)
                ->setDateOfConstruction(new \DateTime($faker->date()))
                ->setSlug($slug)
                ->setEmployee($employee);
            $manager->persist($property);
        }
        $manager->flush();
    }
}
