<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Breaking Bad',
            'summary' => 'Walter White alias Heisenberg deviens un baron de la meth',
            'poster' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Breaking_Bad_logo.svg/langfr-220px-Breaking_Bad_logo.svg.png',
            'category' => 'category_5'
        ],
        [
            'title' => 'Game of Thrones',
            'summary' => 'La bataille de plusieurs royaume pour le trône de fer',
            'poster' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Game_of_Thrones_2011_logo.svg/langfr-240px-Game_of_Thrones_2011_logo.svg.png',
            'category' => 'category_6'
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setPoster($programData['poster']);
            $program->setSummary($programData['summary']);
            $program->setCategory($this->getReference($programData['category']));
            //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }
        $manager->persist($program);
        $this->addReference('program_' . $key, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }


}