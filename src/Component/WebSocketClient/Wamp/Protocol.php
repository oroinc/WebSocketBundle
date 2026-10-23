<?php

namespace Gos\Component\WebSocketClient\Wamp;

/**
 * Copy of Gos\Component\WebSocketClient\Wamp\Protocol
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
final class Protocol
{
    public const MSG_WELCOME = 0;
    public const MSG_PREFIX = 1;
    public const MSG_CALL = 2;
    public const MSG_CALL_RESULT = 3;
    public const MSG_CALL_ERROR = 4;
    public const MSG_SUBSCRIBE = 5;
    public const MSG_UNSUBSCRIBE = 6;
    public const MSG_PUBLISH = 7;
    public const MSG_EVENT = 8;

    private function __construct()
    {
    }
}
