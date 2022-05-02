<?php

namespace Drupal\word_counter\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\word_counter\WordCounter;

class WordCounterTest extends UnitTestCase {

  protected $unit;

  public function setUp(){
    $this->unit = new WordCounter();
  }

  public function testCountFirst(){
    $this->assertEquals(5, $this->unit->count('one two three four five'));
  }

  public function testCountSecond(){
    $this->assertEquals(5, $this->unit->count('<h1>one <span class="big box black">two</span> three four five</h1>'));
  }

}
