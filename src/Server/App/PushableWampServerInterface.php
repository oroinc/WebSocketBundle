<?php declare(strict_types=1);

namespace Gos\Bundle\WebSocketBundle\Server\App;

use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampServerInterface;

/**
 * deprecated to be removed in 4.0, use the symfony/messenger component instead
 */
interface PushableWampServerInterface extends WampServerInterface
{
    /**
     * @param string|array $data
     * @param string       $provider
     */
    public function onPush(WampRequest $request, $data, $provider);
}
