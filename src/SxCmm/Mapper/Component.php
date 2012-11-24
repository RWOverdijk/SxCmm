<?php

namespace SxCmm\Mapper;

class Component extends AbstractMapper
{

    /**
     * @var string FQCN of the entity to use
     */
    protected $entity = 'SxCmm\Entity\Component';

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Find components for area $area on page $pageId
     *
     * @param   string  $area
     * @param   string  $pageId
     * @param   string  $locale
     *
     * @return array
     */
    public function findByAreaAndPage($area, $pageId, $locale = null)
    {
        return $this->getRepository()->findComponents($area, $pageId, $locale);
    }

    /**
     * Get the EntityRepository
     *
     * @return EntityRepository
     */
    protected function getRepository()
    {
        if (null === $this->repository) {
            $this->repository = $this->getEntityManager()->getRepository($this->entity);
        }

       return $this->repository;
    }
}
