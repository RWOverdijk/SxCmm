<?php

namespace SxCmm\Repository;

use Doctrine\ORM\EntityRepository;

class Component extends EntityRepository
{
    public function findComponents($area, $pageId, $locale = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $builder->from('SxCmm\Entity\Component', 'component');
        $builder->select('component');
        $builder->leftJoin('component.settings', 'settings');
        $builder->addSelect('settings');
        $builder->where('component.page_id = :page_id')->setParameter('page_id', $pageId);
        $builder->andWhere('component.area = :area')->setParameter('area', $area);

        $localeWhere = '';

        if (null !== $locale) {
            $localeWhere = 'settings.locale = :locale or ';
            $builder->setParameter('locale', $locale);
        }

        $localeWhere .= 'settings.locale is null';

        $builder->andWhere($localeWhere);
        $builder->orderBy('component.position', 'asc');
        $builder->addOrderBy('settings.locale', 'asc');

        return $builder->getQuery()->getResult();

    }
}
