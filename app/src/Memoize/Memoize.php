<?php

namespace App\Memoize;

trait Memoize
{
    /**
     * @template T
     *
     * @param callable():T $factory
     *
     * @return T
     */
    protected function memoize(callable $factory, ?string $key = null, bool $weak = false): mixed
    {
        if (null === $key) {
            $key = \debug_backtrace(options: \DEBUG_BACKTRACE_IGNORE_ARGS, limit: 2)[1]['function'] ?? null;
        }

        if (!$key) {
            throw new \LogicException('Could not automatically determine memoize key. Pass the key explicitly.');
        }

        return MemoizeCache::getInstance()->get($this, $key, $factory, $weak);
    }

    protected function clearMemoized(?string $key = null): void
    {
        MemoizeCache::getInstance()->clear($this, $key);
    }
}