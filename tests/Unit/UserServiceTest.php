<?php

namespace Tests\Unit;

use App\Services\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_formats_name_to_uppercase()
    {
        $service = new UserService();

        $result = $service->formatName('asjad');

        $this->assertEquals('ASJAD', $result);
    }
}
