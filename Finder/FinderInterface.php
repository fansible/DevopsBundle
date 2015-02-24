<?php

namespace Fansible\DevopsBundle\Finder;

interface FinderInterface
{
    /**
     * @return string
     */
    public function getServiceName();

    /**
     * @return boolean
     */
    public function isPresent();
}
