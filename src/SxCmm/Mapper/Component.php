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
     */
    public function findByAreaAndPage($area, $pageId)
    {
        return  $this->getRepository()->findBy(array(
            'page_id'   => $pageId,
            'area'      => $area,
        ), array('position' => 'asc'));
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
