<?php

namespace Fansible\DevopsBundle\Finder;

use Fansible\DevopsBundle\Finder\Helper\FinderInterface;
use Fansible\DevopsBundle\Config\ServicesConfig;

class NodeFinder implements FinderInterface
{
    /**
     * @var string
     */
    private $rootDir;

    /**
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @inheritdoc
     */
    public function getServiceName()
    {
        return ServicesConfig::NODE;
    }

    /**
     * @inheritdoc
     */
    public function isPresent()
    {
        return file_exists(dirname($this->rootDir) . '/package.json');
    }
}
