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

    /**
     * @return array
     */
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

    /**
     * @param string $service
     *
     * @return bool
     */
    public function isPresent($service)
    {
        return in_array($service, $this->services);
    }
}
