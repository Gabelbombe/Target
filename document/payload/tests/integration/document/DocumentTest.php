<?php
Namespace Tests\Integration
{
    USE Document\Model\Loader;
    USE PHPUnit_Framework_TestCase;

    Class DocumentTest Extends PHPUnit_Framework_TestCase
    {
        protected $file = null;

        public function __construct()
        {
            $this->file = APP_PATH . '/public/files/warp_drive.txt';
        }

        public function testLoaderFileExists()
        {
            $this->assertFileExists($this->file);
        }

        public function testLoaderInstanceOfLoader()
        {
            $loader = New Loader();
            $this->assertInstanceOf('Loader', $loader);

        }
    }
}
