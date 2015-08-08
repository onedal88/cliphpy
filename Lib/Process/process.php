<?php
namespace Cliphpy\Lib;
use Cliphpy\Lib\Element;

class Process extends Element
{
  /**
   * @var array
   */
  protected $options;

  /**
   * @var float
   */
  protected $utime = null;

  /**
   * @var float
   */
  protected $startUtime = null;

  /**
   * @var float
   */
  protected $endUtime = null;

  /**
   * @var float
   */
  protected $uSleep = 0;

  /**
   * @param  integer $signal
   */
  public function close($signal){
    ;
  }

  /**
   * @param  string $alias
   */
  public function initPostgresql($alias = "postgre"){
    $this->{$alias} = new DAO\Postgresql;
    $this->{$alias}->setAlias($alias);
    $this->{$alias}->setConfig($this->config);
  }

  /**
   * @param  string $alias
   */
  public function initRedis($alias = "redis"){
    $this->{$alias} = new CAO\Redis;
    $this->{$alias}->setAlias($alias);
    $this->{$alias}->setConfig($this->config);
  }

  /**
   * @param  string $alias
   */
  public function initMongoDb($alias = "mongo"){
    $this->{$alias} = new DAO\MongoDb;
    $this->{$alias}->setAlias($alias);
    $this->{$alias}->setConfig($this->config);
  }

  /**
   * @param array $options
   */
  public function setOptions(array $options){
    $this->options = $options;
  }

  /**
   * @return array
   */
  public function getOptions(){
    return $this->options;
  }

  public function runInLoop(){
    if (is_null($this->utime)){
      throw new Exception("Process attribute utime is null.", 2);
    }
    do {
      $this->startUtime = microtime(true);
      $this->runLoop();
      $this->endUtime = microtime(true);
      $this->uSleep = $this->utime - ($this->endUtime - $this->startUtime);

      if ($this->uSleep > 0){
        usleep($this->uSleep * 1000);
      }
    } while (true);
  }

  public function runLoop(){
    throw new Exception("Process method runLoop() - change it.", 3);
  }
}
