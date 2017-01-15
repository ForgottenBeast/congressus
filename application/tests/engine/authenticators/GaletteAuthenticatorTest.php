<?php
require_once '../../mocks/MockPDO.php';
require_once '../../../engine/authenticators/GaletteAuthenticator.php';

class GaletteAuthenticatorTest extends PHPUnit_Framework_TestCase{
	private static $database = "test_db";
	private $pdo;

	protected function setUp(){
	    $this->pdo = new MockPDO();
    }
	public function testInstanciation(){
		$auth = GaletteAuthenticator::newInstance($this->pdo, GaletteAuthenticatorTest::$database);
		$this->assertTrue($auth->pdo == $this->pdo,"passed pdo is used");
	}
}
