<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\ExtractClassNameHelper;
use App\Models\User;
use App\Models\WaterType;

class ExtractClassNameHelperTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_extract_normal_class_name(): void
    {
        $fullyQualifiedClassName = User::class;
        $result = ExtractClassNameHelper::extract($fullyQualifiedClassName);

        $this->assertEquals('user', $result);
    }

    /**
     * A basic unit test example.
     */
    public function test_extract_camel_class_name(): void
    {
        $fullyQualifiedClassName = WaterType::class;
        $result = ExtractClassNameHelper::extract($fullyQualifiedClassName);

        $this->assertEquals('water type', $result);
    }
}
