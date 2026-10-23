<?php

namespace Gos\Component\WebSocketClient\Wamp;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Copy of Gos\Component\WebSocketClient\Wamp\ClientFactory
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Johann Saunier <johann_27@hotmail.fr>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */
final class ClientFactory implements ClientFactoryInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $this->resolveConfig($config);
    }

    public function createConnection(): ClientInterface
    {
        $client = new Client(
            $this->config['host'],
            $this->config['port'],
            $this->config['ssl'],
            $this->config['origin']
        );

        if (null !== $this->logger) {
            $client->setLogger($this->logger);
        }

        return $client;
    }

    private function resolveConfig(array $config): array
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(
            [
                'host',
                'port',
            ]
        );

        $resolver->setDefaults(
            [
                'ssl' => false,
                'origin' => null,
            ]
        );

        $resolver->setAllowedTypes('host', 'string');
        $resolver->setAllowedTypes('port', ['string', 'integer']);
        $resolver->setAllowedTypes('ssl', 'boolean');
        $resolver->setAllowedTypes('origin', ['string', 'null']);

        return $resolver->resolve($config);
    }
}
