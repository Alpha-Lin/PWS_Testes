<?php

namespace App\Test\Controller;

use App\Entity\CritereSolution;
use App\Repository\CritereSolutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CritereSolutionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CritereSolutionRepository $repository;
    private string $path = '/critere/solution/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(CritereSolution::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CritereSolution index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'critere_solution[point]' => 'Testing',
            'critere_solution[tentativ]' => 'Testing',
            'critere_solution[critere]' => 'Testing',
        ]);

        self::assertResponseRedirects('/critere/solution/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new CritereSolution();
        $fixture->setPoint('My Title');
        $fixture->setTentativ('My Title');
        $fixture->setCritere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CritereSolution');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new CritereSolution();
        $fixture->setPoint('My Title');
        $fixture->setTentativ('My Title');
        $fixture->setCritere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'critere_solution[point]' => 'Something New',
            'critere_solution[tentativ]' => 'Something New',
            'critere_solution[critere]' => 'Something New',
        ]);

        self::assertResponseRedirects('/critere/solution/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPoint());
        self::assertSame('Something New', $fixture[0]->getTentativ());
        self::assertSame('Something New', $fixture[0]->getCritere());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new CritereSolution();
        $fixture->setPoint('My Title');
        $fixture->setTentativ('My Title');
        $fixture->setCritere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/critere/solution/');
    }
}
