<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use Faker\Factory;
use Faker\Generator;

trait FakerTool
{
    public function faker(): Generator
    {
        return Factory::create();
    }
}
