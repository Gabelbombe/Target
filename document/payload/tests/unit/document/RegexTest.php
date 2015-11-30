<?php
Namespace Tests\Integration
{
    USE Document\Controller\Search\Regex;
    USE PHPUnit_Framework_TestCase;

    Class RegexTest Extends PHPUnit_Framework_TestCase
    {
        protected $file   = null,
                  $regex  = null,
                  $params = [];

        public function __construct()
        {
            $this->file = APP_PATH . '/public/files/warp_drive.txt';

            $this->params = [
                'type' => 2,
                'args' => [
                    'file' => $this->file,
                    'type' => 'regex',
                    'find' => 'space',
                ],
            ];
        }

        public function testLoaderFileExists()
        {
            $this->assertFileExists($this->file);
        }

        public function testRegexExists()
        {
            $this->regex = New Regex();
            $this->assertTrue(is_object($this->regex));
        }
    }
}
