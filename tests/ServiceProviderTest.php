<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Vimeo;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vimeo\Vimeo;
use Vinkla\Vimeo\VimeoFactory;
use Vinkla\Vimeo\VimeoManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testVimeoFactoryIsInjectable()
    {
        $this->assertIsInjectable(VimeoFactory::class);
    }

    public function testVimeoManagerIsInjectable()
    {
        $this->assertIsInjectable(VimeoManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Vimeo::class);

        $original = $this->app['vimeo.connection'];
        $this->app['vimeo']->reconnect();
        $new = $this->app['vimeo.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
