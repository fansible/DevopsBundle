<?php

namespace Fansible\DevopsBundle\Tests\Finder;

use Fansible\DevopsBundle\Finder\NodeFinder;

class NodeFinderTest extends \PHPUnit_Framework_TestCase
{
    public function testServiceName()
    {
        $nodeFinder = new NodeFinder('');

        $this->assertEquals('node', $nodeFinder->getServiceName());
    }

    public function testServiceIsNotPresent()
    {
        $nodeFinder = new NodeFinder(__DIR__ . '/test');

        $this->assertFalse($nodeFinder->isPresent());
    }

    public function testServiceIsPresent()
    {
        $nodeFinder = new NodeFinder(__DIR__ . '/../ressources/test');

        $this->assertTrue($nodeFinder->isPresent());
    }
}
