<?php declare(strict_types=1);

namespace Swoft\View;

use Swoft\Helper\ComposerJSON;
use Swoft\Server\Swoole\SwooleEvent;
use Swoft\SwoftComponent;
use Swoft\WebSocket\Server\Router\Router;
use Swoft\WebSocket\Server\Swoole\CloseListener;
use Swoft\WebSocket\Server\Swoole\HandshakeListener;
use Swoft\WebSocket\Server\Swoole\MessageListener;

/**
 * Class AutoLoader
 *
 * @since 2.0
 */
class AutoLoader extends SwoftComponent
{
    /**
     * @return bool
     */
    public function enable(): bool
    {
        return (bool)\env('ENABLE_WS_SERVER', true);
    }

    /**
     * Get namespace and dir
     *
     * @return array
     * [
     *     namespace => dir path
     * ]
     */
    public function getPrefixDirs(): array
    {
        return [__NAMESPACE__ => __DIR__];
    }

    /**
     * Metadata information for the component.
     *
     * @return array
     * @see ComponentInterface::getMetadata()
     */
    public function metadata(): array
    {
        $jsonFile = \dirname(__DIR__) . '/composer.json';

        return ComposerJSON::open($jsonFile)->getMetadata();
    }

    /**
     * @return array
     */
    public function coreBean(): array
    {
        return [
            'view'     => [
                'class'     => Renderer::class,
            ],
        ];
    }
}
