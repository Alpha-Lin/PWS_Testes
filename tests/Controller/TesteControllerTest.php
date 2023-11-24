<?php

namespace App\Test\Controller;

use App\Entity\Teste;
use App\Repository\TesteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TesteControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TesteRepository $repository;
    private string $path = '/teste/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Teste::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Teste index');

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
            'teste[imageTeste]' => 'Testing',
            'teste[user]' => 'Testing',
            'teste[typeTeste]' => 'Testing',
        ]);

        self::assertResponseRedirects('/teste/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Teste();
        $fixture->setImageTeste('My Title');
        $fixture->setUser('My Title');
        $fixture->setTypeTeste('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Teste');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Teste();
        $fixture->setImageTeste('My Title');
        $fixture->setUser('My Title');
        $fixture->setTypeTeste('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'teste[imageTeste]' => 'Something New',
            'teste[user]' => 'Something New',
            'teste[typeTeste]' => 'Something New',
        ]);

        self::assertResponseRedirects('/teste/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getImageTeste());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getTypeTeste());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Teste();
        $fixture->setImageTeste('My Title');
        $fixture->setUser('My Title');
        $fixture->setTypeTeste('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/teste/');
    }
}
