<?php declare(strict_types=1);

namespace Gos\Bundle\WebSocketBundle\Pusher;

/**
 * @internal
 *
 * deprecated to be removed in 4.0, use the symfony/messenger component instead
 */
final class Message
{
    private string $topic;
    private array $data;

    public function __construct(string $topic, array $data)
    {
        $this->topic = $topic;
        $this->data = $data;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
