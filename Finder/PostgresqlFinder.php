<?php

namespace Fansible\DevopsBundle\Finder;

use Fansible\DevopsBundle\Finder\Helper\FinderInterface;

class PostgresqlFinder implements FinderInterface
{
    const NAME = 'postgresql';

    /**
     * @var \Fansible\DevopsBundle\Finder\Helper\DoctrineHelper
     */
    private $doctrineHelper;

    /**
     * @param \Fansible\DevopsBundle\Finder\Helper\DoctrineHelper $doctrineHelper
     */
    public function __construct($doctrineHelper)
    {
        $this->doctrineHelper = $doctrineHelper;
    }

    /**
     * @inheritdoc
     */
    public function getServiceName()
    {
        return self::NAME;
    }

    /**
     * @inheritdoc
     */
    public function isPresent()
    {
        return $this->doctrineHelper->isPresent('pdo_pgsql');
    }
}
