<?php

namespace Fansible\DevopsBundle\Finder\Helper;

class FinderContainer
{
    /**
     * @var array
     */
    private $services;

    /**
     * @var array
     */
    private $finders;

    /**
     * @param FinderInterface $finder
     */
    public function addFinder(FinderInterface $finder)
    {
        $this->finders[] = $finder;
    }

    public function getServices()
    {
        if (empty($this->services)) {
            /** @var FinderInterface $finder */
            foreach ($this->finders as $finder) {
                if ($finder->isPresent()) {
                    $this->services[] = $finder->getServiceName();
                }
            }
        }

        return $this->services;
    }
}
