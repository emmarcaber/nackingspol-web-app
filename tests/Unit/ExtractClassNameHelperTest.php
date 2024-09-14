<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\ExtractClassNameHelper;

class ExtractClassNameHelperTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_extract_class_name(): void
    {
        $fullyQualifiedClassName = 'App\\Models\\User';
        $result = ExtractClassNameHelper::extract($fullyQualifiedClassName);

        $this->assertEquals('user', $result);
    }
}
