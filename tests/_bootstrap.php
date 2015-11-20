<?php
// This is global bootstrap for autoloading
use Rhubarb\Crown\Context;

include __DIR__."/../vendor/autoload.php";

$context = new Context();
$context->ApplicationModuleFile = __DIR__."/../application/settings/app.config.php";

include __DIR__."/../vendor/rhubarbphp/rhubarb/platform/execute-test.php";