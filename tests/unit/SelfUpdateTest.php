<?php

namespace AccuracodeTests\SelfUpdate\Unit;

use Accuracode\SelfUpdate\Driver\Github\Driver;
use Accuracode\SelfUpdate\SelfUpdate;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use PHPUnit\Framework\TestCase;

class SelfUpdateTest extends TestCase
{

    public function testGithub()
    {
        $updater = new SelfUpdate(
            new Driver('composer', 'composer'),
            new Client(),
            new HttpFactory()
        );

        $last = $updater->getUpdates();

        $a = 1;
    }
}
