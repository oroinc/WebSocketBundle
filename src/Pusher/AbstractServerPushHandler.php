<?php declare(strict_types=1);

namespace Gos\Bundle\WebSocketBundle\Pusher;

/**
 * deprecated to be removed in 4.0, use the symfony/messenger component instead
 */
abstract class AbstractServerPushHandler implements ServerPushHandlerInterface
{
    private string $name = '';

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
