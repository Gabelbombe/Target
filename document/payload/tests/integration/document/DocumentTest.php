<?php
Namespace Tests\Integration
{
    USE Document\Model\Loader;
    USE PHPUnit_Framework_TestCase;

    Class DocumentTest Extends PHPUnit_Framework_TestCase
    {
        protected $file   = null,
                  $loader = null;

        public function __construct()
        {
            $this->file = APP_PATH . '/public/files/warp_drive.txt';
        }

        public function testLoaderFileExists()
        {
            $this->assertFileExists($this->file);
        }

        public function testLoaderExists()
        {
            $this->loader = New Loader();
            $this->assertTrue(is_object($this->loader));
        }

        public function testLoaderHasPublicMethods()
        {
            foreach(['strip', 'removeCommonWords'] AS $method)
            {
                $this->assertTrue(
                    method_exists($this->loader, $method), 'Class does not have method ' . $method
                );
            }
        }
    }
}
