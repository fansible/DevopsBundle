<?php

namespace Fansible\DevopsBundle\Finder\Helper;

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
