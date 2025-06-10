<?php

namespace Tests\Modules\Lobbies\Services;

use App\Modules\Lobbies\Services\LobbyService;
use PHPUnit\Framework\TestCase;

class LobbyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new LobbyService();
    }

    public function testFindLobbyByCategoryIds()
    {
//        $this->assertEquals($this->service->findLobbyByCategoryIds([1, 2, 3]), [1, 2, 3]);
    }
}
