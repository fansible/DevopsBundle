<?php

namespace Fansible\DevopsBundle\Finder;

class MysqlFinder implements FinderInterface
{
    const NAME = 'mysql';

    /** @var \Doctrine\DBAL\Driver\Connection $connection */
    private $dbal;

    /**
     * @param \Doctrine\DBAL\Driver\Connection $dbal
     */
    public function __construct($dbal = null)
    {
        $this->dbal = $dbal;
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
        if (null !== $this->dbal && $this->dbal->getDriver()->getName() == 'pdo_mysql') {
            return true;
        }

        return false;
    }
}
