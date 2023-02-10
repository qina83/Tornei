<?php

namespace App\Common\Tests\Application;

use App\GestioneTornei\Infrastructure\Entity\TorneoStateEntity;
use App\GestioneUtenti\Infrastructure\Entity\GiocatoreStateEntity;
use App\Partite\Infrastructure\Entity\GiocatoreAttivoEntity;
use App\Partite\Infrastructure\Entity\TorneoAttivoEntity;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BaseWebTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->cleanDB();
    }

    /**
     * @throws Exception
     */
    private function truncateEntities(array $entities): void
    {
        $connection = $this->getEntityManager()->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();

        foreach ($entities as $entity) {
            $query = $databasePlatform->getTruncateTableSQL(
                $this->getEntityManager()->getClassMetadata($entity)->getTableName()
            );
            $connection->executeQuery($query);
        }
    }

    /**
     * @throws Exception
     */
    protected function cleanDB(): void
    {
        $this->truncateEntities(
            [
                GiocatoreStateEntity::class,
                GiocatoreAttivoEntity::class,
                TorneoStateEntity::class,
                TorneoAttivoEntity::class,
            ]
        );
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function checkResponse404(): void
    {
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    protected function checkResponse400(): void
    {
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    protected function checkResponse200(): void
    {
        $this->assertResponseIsSuccessful();
    }

    protected function get(string $url): array
    {
        $this->client->request('GET',
            $url
        );

        return json_decode($this->client->getResponse()->getContent(), true);
    }

    protected function post(string $url, array $data): void
    {
        $this->client->request('POST',
            $url,
            [],
            [],
            [],
            json_encode($data)
        );
    }

    protected function patch(string $url, array $data): void
    {
        $this->client->request('PATCH',
            $url,
            [],
            [],
            [],
            json_encode($data)
        );
    }
}
