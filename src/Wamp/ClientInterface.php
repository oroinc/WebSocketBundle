<?php

namespace Gos\Bundle\WebSocketBundle\Wamp;

use Gos\Bundle\WebSocketBundle\Exception\BadResponseException;
use Gos\Bundle\WebSocketBundle\Exception\WebsocketException;

/**
 * Copy of Gos\Component\WebSocketClient\Wamp\ClientInterface
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
interface ClientInterface
{
    /**
     * @return string The session identifier for the connection
     *
     * @throws BadResponseException if a response could not be received from the websocket server
     * @throws WebsocketException   if the target URI is invalid
     */
    public function connect(string $target = '/'): string;

    /**
     * @throws WebsocketException if the connection could not be disconnected cleanly
     */
    public function disconnect(): bool;

    public function isConnected(): bool;

    /**
     * Establish a prefix on server.
     *
     * @see http://wamp.ws/spec#prefix_message
     */
    public function prefix(string $prefix, string $uri): void;

    /**
     * Call a procedure on server.
     *
     * @see http://wamp.ws/spec#call_message
     *
     * @param array|mixed $args Arguments for the message either as an array or variadic set of parameters
     */
    public function call(string $procUri, $args): void;

    /**
     * The client will send an event to all clients connected to the server who have subscribed to the topicURI.
     *
     * @see http://wamp.ws/spec#publish_message
     *
     * @param string[] $exclude
     * @param string[] $eligible
     */
    public function publish(string $topicUri, string $payload, array $exclude = [], array $eligible = []): void;

    /**
     * Subscribers receive PubSub events published by subscribers via the EVENT message. The EVENT message contains the topicURI, the topic under which the event was published, and event, the PubSub event payload.
     */
    public function event(string $topicUri, string $payload): void;
}
