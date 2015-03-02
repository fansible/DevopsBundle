<?php

namespace Fansible\DevopsBundle\Config;

class VagrantConfig
{
    /** @var string */
    private $projectName;
    /** @var string */
    private $box;
    /** @var string */
    private $ip;
    /** @var string */
    private $memory;
    /** @var string */
    private $cpus;
    /** @var string */
    private $exec;
    /** @var string */
    private $src;
    /** @var string */
    private $dest;
    /** @var string */
    private $hostfile;

    /**
     * @param string $projectName
     * @param string $box
     * @param string $ip
     * @param string $memory
     * @param string $cpus
     * @param string $exec
     * @param string $src
     * @param string $dest
     * @param string $hostfile
     */
    public function __construct($projectName, $box, $ip, $memory, $cpus, $exec, $src, $dest, $hostfile)
    {
        $this->projectName = $projectName;
        $this->box = $box;
        $this->ip = $ip;
        $this->memory = $memory;
        $this->cpus = $cpus;
        $this->exec = $exec;
        $this->src = $src;
        $this->dest = $dest;
        $this->hostfile = $hostfile;
    }

    /**
     * @return string
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * @return string
     */
    public function getCpus()
    {
        return $this->cpus;
    }

    /**
     * @return string
     */
    public function getDest()
    {
        return $this->dest;
    }

    /**
     * @return string
     */
    public function getExec()
    {
        return $this->exec;
    }

    /**
     * @return string
     */
    public function getHostfile()
    {
        return $this->hostfile;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }
}
