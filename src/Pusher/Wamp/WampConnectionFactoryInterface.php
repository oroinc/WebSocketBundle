<?php declare(strict_types=1);

namespace Gos\Bundle\WebSocketBundle\Pusher\Wamp;

use Gos\Bundle\WebSocketBundle\Wamp\ClientFactoryInterface;

/**
 * @deprecated to be removed in 4.0, use the Gos\Component\WebSocketClient\Wamp\ClientFactoryInterface from the gos/websocket-client package instead
 */
interface WampConnectionFactoryInterface extends ClientFactoryInterface
{
}
