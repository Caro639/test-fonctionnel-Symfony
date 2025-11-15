<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Utilisateur de test pour les tests fonctionnels
        $testUser = new User();
        $testUser->setUserName('your_test_username');
        $testUser->setFullname('Caroline Test');
        $testUser->setEmail('your email used in fixtures');
        $testUser->setAvatarUrl('https://github.com/avatar_test');
        $testUser->setProfileHtmlUrl('https://github.com/your_test_username');
        $testUser->setPassword('test');
        $testUser->setRoles(['ROLE_USER']);
        $manager->persist($testUser);

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            $user->setUserName($faker->userName);
            $user->setFullname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setAvatarUrl($faker->url . '_avatar');
            $user->setProfileHtmlUrl($faker->url . '_profile');
            $user->setPassword('test');
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
