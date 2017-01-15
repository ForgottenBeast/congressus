<?php
require_once '../../mocks/MockPDO.php';
require_once '../../../engine/authenticators/GaletteAuthenticator.php';

class GaletteAuthenticatorTest extends PHPUnit_Framework_TestCase{
	private static $database = "test_db";
	
	public function testInstanciation(){
		$pdo = new MockPDO();
		$auth = GaletteAuthenticator::newInstance($pdo, GaletteAuthenticatorTest::$database);
		$this->assertTrue($auth->pdo == $pdo,"passed pdo is used");
	}
}
