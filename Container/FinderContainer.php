<?php

namespace Fansible\DevopsBundle\Container;

use Fansible\DevopsBundle\Finder\FinderInterface;

class FinderContainer
{
    /**
     * @var array $services
     */
    private $services = [];

    /**
     * @param FinderInterface $finder
     */
    public function addFinder(FinderInterface $finder)
    {
        $this->services[$finder->getServiceName()][] = $finder;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        $services = [];

        foreach ($this->services as $finders) {
            /** @var FinderInterface $finder */
            foreach ($finders as $finder) {
                if ($finder->isPresent()) {
                    $services[] = $finder->getServiceName();
                }
            }
        }

        return $services;
    }
}
