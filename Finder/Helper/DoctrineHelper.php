<?php

namespace Fansible\DevopsBundle\Finder\Helper;

class DoctrineHelper
{
    /**
     * @var \Doctrine\DBAL\Driver\Connection|null
     */
    private $dbal;

    /**
     * @param \Doctrine\DBAL\Driver\Connection $dbal
     */
    public function __construct($dbal = null)
    {
        $this->dbal = $dbal;
    }

    /**
     * @param string $pdo
     *
     * @return bool
     */
    public function isPresent($pdo)
    {
        return null !== $this->dbal && $this->dbal->getDriver()->getName() == $pdo;
    }
}
