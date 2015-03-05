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
     * @param array  $config
     */
    public function __construct($projectName, array $config)
    {
        $this->projectName = $projectName;
        $this->box = $config['box'];
        $this->ip = $config['ip'];
        $this->memory = $config['memory'];
        $this->cpus = $config['cpus'];
        $this->exec = $config['exec'];
        $this->src = $config['src'];
        $this->dest = $config['dest'] ? $config['dest'] : '/var/www/' . $projectName . '/current';
        $this->hostfile = $config['hostfile'];
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
