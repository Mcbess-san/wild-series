<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        'Norman Reedus',
        'Danai Gurira',
        'Bryan Cranston',
        'Aaron Paul',
        'Kaley Cuoco',
        'Jim Parsons',
        'Kit Harington',
        'Emilia Clarke',
        'Sean Bean',
        'Maisie Williams',
        'Erik Per Sullivan'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}
