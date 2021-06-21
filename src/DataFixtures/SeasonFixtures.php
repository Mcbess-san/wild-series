<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'number' => '1',
            'year' => '2008',
            'description' => 'Walter « Walt » White est un professeur de chimie dans un lycée du Nouveau-Mexique et un père de famille de 50 ans.
            Sa femme Skyler est enceinte et son fils Walter Jr. est handicapé. Son quotidien déjà morose devient carrément noir lorsqu\'il apprend 
            qu\'il est atteint d\'un incurable cancer des poumons. Les médecins ne lui donnent que deux ans à vivre.',
            'program' => 'program_0'  
        ],
        [
            'number' => '2',
            'year' => '2009',
            'description' => 'Walter commence à se faire un nom dans le milieu de la drogue, sous le pseudonyme d\'Heisenberg. La nouvelle double
            vie de Walter manque à maintes reprises d\'être découverte par sa famille, à qui il a finalement avoué son cancer. Skyler, très inquiète,
            décide de reprendre son ancien travail de comptable, alors qu\'elle est à huit mois de grossesse.',
            'program' => 'program_0'
        ],
        [
            'number' => '1',
            'year' => '2011',
            'description' => 'Sur le continent de Westeros, le roi Robert Baratheon règne sur le Royaume des Sept
            Couronnes depuis qu\'il a mené à la victoire la rébellion contre le roi fou, Aerys II Targaryen, dix-sept ans plus tôt.',
            'program' => 'program_1' 
        ],
        [
            'number' => '2',
            'year' => '2012',
            'description' => 'Après la mort du roi Robert Baratheon et d\'Eddard Stark,
            la légitimité du roi Joffrey est contestée par Stannis et Renly, frères de Robert, tandis que Sansa Stark est retenue comme otage à Port-Réal.',  
            'program' => 'program_1'
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $bbseasonData) {
            $season = new Season();
            $season->setNumber($bbseasonData['number']);
            $season->setYear($bbseasonData['year']);
            $season->setDescription($bbseasonData['description']);
            $season->setProgram($this->getReference($bbseasonData['program']));
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }
}
