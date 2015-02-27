<?php

namespace Fansible\DevopsBundle\Generator\Helper;

class GeneratorContainer implements GeneratorInterface
{
    /**
     * @var array
     */
    private $generators;

    /**
     * @param GeneratorInterface $generator
     */
    public function addGenerator(GeneratorInterface $generator)
    {
        $this->generators[] = $generator;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        /** @var GeneratorInterface $generator */
        foreach ($this->generators as $generator) {
            $generator->generate();
        }
    }
}
