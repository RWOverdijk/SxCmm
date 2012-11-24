<?php

namespace SxCmm\Mapper;

use Doctrine\ORM\EntityManager;

class AbstractMapper
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * Find a record by id
     *
     * @param integer $id
     */
    public function findById($id)
    {
        $entity = $this->getRepository()->find($id);

        return $entity;
    }

    /**
     * Set the entity manager
     *
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get the entity manager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }
}
