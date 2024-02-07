<?php

namespace utils;

use DateInterval;
use DateTime;

use function Castor\fingerprint;
use function Castor\hasher;
use function Castor\http_client;
use function Castor\run;
use function is_dir;

function import_from_http_remote(string $url): void
{
    $response = http_client()->request('GET', $url);

    $filename = basename($url);
    $filename = explode('?', $filename)[0];
    $destinationDir = __DIR__ . '/remote-imported';
    $destinationFile = $destinationDir . '/' . $filename;

    if (!is_dir($destinationDir) && !mkdir($destinationDir) && !is_dir($destinationDir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $destinationDir));
    }

    file_put_contents($destinationFile, $response->getContent());
}

function import_from_git_remote(string $url): void
{
    $destinationDir = __DIR__ . '/remote-imported';
    $repositoryDir = $destinationDir . '/' . basename($url, '.git');

    if (is_dir($repositoryDir)) {
        fingerprint(
            callback: function () use ($repositoryDir) {
                run('git pull', path: $repositoryDir);
            },
            fingerprint: prevent_update($url)
        );
        return;
    }

    run("git clone --depth=1 $url", path: $destinationDir);
}

function prevent_update(string $url): string
{
    return hasher()
        ->write((new DateTime())->add(new DateInterval('P7D'))->format('Y-m-d'))
        ->write($url)
        ->finish();
}