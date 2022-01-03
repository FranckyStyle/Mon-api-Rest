<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

/**
 *
 */
class ContactDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    private $_slugger;

    public function __construct(
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ) {
        $this->_entityManager = $entityManager;
        $this->_slugger = $slugger;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Contact;
    }

    /**
     * @param Contact $data
     */
    public function persist($data, array $context = [])
    {
        $data->setSlug(
            $this
            ->_slugger 
            ->slug(strtolower($data->getTelephone())). '-' .uniqid()
        );

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}