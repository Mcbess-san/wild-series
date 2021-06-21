<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'Chute libre',
            'number' => '1',
            'synopsis' => 'Walter White, 50 ans, est Professeur de chimie dans un lycée public.
            Il travaille parallèlement dans une station de lavage de voitures afin de boucler les fins de mois...',
            'season' => 'season_0'  
        ],
        [
            'title' => 'Le Choix',
            'number' => '2',
            'synopsis' => 'Le lendemain, Walter et Jesse réussissent à sortir le camping-car du fossé dans le désert.
            Mais ils doivent se débarrasser des corps de Krazy-8 et Emilio à l\'arrière du véhicule.
            Leur tâche se complique quand ils découvrent avec stupéfaction que l\'un d\'entre eux a survécu.
            Les deux acolytes ne sont pas d\'accord quant à la marche à suivre...',
            'season' => 'season_1'  
        ],
        [
            'title' => 'L\'hiver vient',
            'number' => '1',
            'synopsis' => 'Sur le continent de Westeros, une unité de la Garde de Nuit, chargée de veiller sur le Mur,
            est presque entièrement massacrée lors d\'une patrouille au nord du Mur. Un jeune patrouilleur réussit à s\'enfuir,
            mais il est arrêté et condamné à mort pour désertion par Eddard Stark, seigneur de Winterfell et gouverneur du Nord.
            Au moment où sa sentence s\'apprête à être exécutée, le déserteur révèle que ce sont les Marcheurs Blancs, des créatures surnaturelles,
            qui ont tué ses compagnons...',
            'season' => 'season_0'
        ],
        [
            'title' => 'La Route royale',
            'number' => '2',
            'synopsis' => 'Daenerys Targaryen, fraîchement mariée à Khal Drogo, entreprend avec les Dothrakis et son frère le long voyage vers Vaes Dothrak.
            Afin de mieux satisfaire son mari et de prendre du plaisir à le faire, elle prend des leçons d\'amour auprès d\'une de ses caméristes.
            Elle peut compter également sur Jorah Mormont qui lui explique les traditions de son nouveau peuple.
            Ce dernier est exilé par Ned Stark après avoir arrêté des braconniers sur ses terres avant de les vendre comme esclaves...',
            'season' => 'season_0'  
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodeData) {
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);
            $episode->setSynopsis($episodeData['synopsis']);
            $episode->setSeason($this->getReference($episodeData['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
          SeasonFixtures::class,
        ];
    }
}
