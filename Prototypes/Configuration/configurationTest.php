<?php
namespace Cliphpy\Prototypes;

class testConfiguration extends \PHPUnit_Framework_TestCase
{
  /**
   * @use \Cliphpy\Prototypes\Configuration::__construct
   */
  public function testConstruct(){
    $testObj = new Configuration;

    $logDirExpected = __DIR__ . "/../log";
    $pidDirExpected = __DIR__ . "/../pid";

    $this->assertEquals($logDirExpected, $testObj->logDir);
    $this->assertEquals($pidDirExpected, $testObj->pidDir);
  }

}