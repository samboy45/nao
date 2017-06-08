<?php

namespace AppBundle\Command;

use AppBundle\Entity\Espece;
use AppBundle\Entity\Famille;
use AppBundle\Entity\Ordre;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppEspecesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:especes')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $em EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        // yolo
        ini_set("memory_limit", "-1");

        // On vide les 3 tables
        $connection = $em->getConnection();
        $platform   = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('Espece', true /* whether to cascade */));
        $connection->executeUpdate($platform->getTruncateTableSQL('Ordre', true /* whether to cascade */));
        $connection->executeUpdate($platform->getTruncateTableSQL('Famille', true /* whether to cascade */));

        $csv = dirname($this->getContainer()->get('kernel')->getRootDir()) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'taxref.csv';
        $lines = explode("\n", file_get_contents($csv));
        $Ordres = [];
        $Familles = [];
        $Especes = [];

        foreach ($lines as $k => $line) {
            $line = explode(';', $line);
            if (count($line) > 5 && $k > 0) {
                // On sauvegarde l'Ordre
                if (!key_exists($line[0], $Ordres)) {
                    $Ordre = new Ordre();
                    $Ordre->setNomOrdre($line[0]);
                    $Ordres[$line[0]] = $Ordre;
                    $em->persist($Ordre);
                } else {
                    $Ordre = $Ordres[$line[0]];
                }

                // On sauvegarde la Famille
                if (!key_exists($line[1], $Familles)) {
                    $Famille = new Famille();
                    $Famille->setNomFamille($line[1]);
                    $Famille->setOrdre($Ordre);
                    $Familles[$line[1]] = $Famille;
                    $em->persist($Famille);
                } else {
                    $Famille = $Familles[$line[1]];
                }

                // On sauvegarde la Espece
                $Espece = new Espece();
                $Espece->setLbNom($line[2]);
                $Espece->setNomValide($line[4]);
                $Espece->setNomVern($line[5]);
                $Espece->setFamille($Famille);
                $Especes[] = $line[2];
                $em->persist($Espece);
            }
        }
        $em->flush();
        $output->writeln(count($Especes) . ' Especes importées');
    }

}
