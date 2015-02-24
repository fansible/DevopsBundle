<?php

namespace Fansible\DevopsBundle\Generator;

class TwigHelper
{
    /** @var \Twig_Environment */
    private $twig;

    /** @var string */
    protected $rootDir;

    /**
     * @param \Twig_Environment $twig
     * @param string            $rootDir
     */
    public function __construct($twig, $rootDir)
    {
        $this->twig = $twig;
        $this->rootDir = $rootDir;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function getTwigPath($path)
    {
        return dirname(__DIR__) . '/Resources/views/' . $path;
    }

    /**
     * @param string $fileName
     * @param string $twigFile
     * @param array  $parameters
     */
    public function render($fileName, $twigFile, $parameters = [])
    {
        if (!is_dir(dirname($fileName))) {
            mkdir(dirname($fileName), 0777, true);
        }

        file_put_contents($fileName ,$this->twig->render($twigFile, $parameters));
    }
}
