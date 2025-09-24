<?php

namespace Gos\Bundle\WebSocketBundle\Wamp;

/**
 * Copy of Gos\Component\WebSocketClient\Wamp\PayloadGenerator
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
final class PayloadGenerator implements PayloadGeneratorInterface
{
    public function encode(WebsocketPayload $websocketPayload): string
    {
        $payload = $websocketPayload->getFin() << 1 | $websocketPayload->getRsv1();
        $payload = $payload << 1 | $websocketPayload->getRsv2();
        $payload = $payload << 1 | $websocketPayload->getRsv3();
        $payload = $payload << 4 | $websocketPayload->getOpcode();
        $payload = $payload << 1 | $websocketPayload->getMask();

        if ($websocketPayload->getLength() <= 125) {
            $payload = $payload << 7 | $websocketPayload->getLength();
            $payload = pack('n', $payload);
        } elseif ($websocketPayload->getLength() <= 0xffff) {
            $payload = $payload << 7 | 126;
            $payload = pack('n', $payload).pack('n*', $websocketPayload->getLength());
        } else {
            $payload = $payload << 7 | 127;
            $payload = pack('n', $payload).pack('NN', ($websocketPayload->getLength() & 0xffffffff00000000) >> 32, $websocketPayload->getLength() & 0x00000000ffffffff);
        }

        if (0x1 == $websocketPayload->getMask()) {
            $payload .= $websocketPayload->getMaskKey();
            $data = $this->maskData($websocketPayload->getPayload(), $websocketPayload->getMaskKey());
        } else {
            $data = $websocketPayload->getPayload();
        }

        return $payload.$data;
    }

    public function generateClosePayload(): string
    {
        $str = '';

        foreach (str_split(sprintf('%016b', 1000), 8) as $binstr) {
            $str .= \chr((int) bindec($binstr));
        }

        return $str.'ttfn';
    }

    private function maskData(?string $data, ?string $key): string
    {
        $masked = '';

        for ($i = 0; $i < \strlen($data); ++$i) {
            $masked .= $data[$i] ^ $key[$i % 4];
        }

        return $masked;
    }
}
