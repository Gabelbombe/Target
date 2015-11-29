<?php
Namespace Tests\Integration
{
    USE Document\Model\Loader;
    USE PHPUnit_Framework_TestCase;

    Class DocumentTest Extends PHPUnit_Framework_TestCase
    {
        public function testLoaderLoadFile()
        {
            $file = APP_PATH . '/public/files/warp_drive.txt';
            $this->assertFileExists($file);

            $loader = New Loader($file);
        }
    }
}
