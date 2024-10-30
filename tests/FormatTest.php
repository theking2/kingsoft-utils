<?php declare(strict_types=1);
use \Kingsoft\Utils\Format;

class FormatTest extends \PHPUnit\Framework\TestCase
{
  public function test_proc_diff()
  {
    $this->assertEquals(
      'n.a.',
      Format::proc_diff( 0, 0 )
    );
    $this->assertEquals(
      '-100.0%',
      Format::proc_diff( 0, 1 )
    );
    $this->assertEquals(
      'n.a.',
      Format::proc_diff( 1, 0 )
    );
    $this->assertEquals(
      '100.0%',
      Format::proc_diff( 1, 0.5 )
    );
    $this->assertEquals(
      'n.a.',
      Format::proc_diff( 0.5, 0 )
    );
    $this->assertEquals(
      '100.0%',
      Format::proc_diff( 0.5, 0.25 )
    );
    $this->assertEquals(
      '-50.0%',
      Format::proc_diff( 0.25, 0.5 )
    );
    $this->assertEquals(
      '100.0%',
      Format::proc_diff( 0.25, 0.125 )
    );
    $this->assertEquals(
      '-50.0%',
      Format::proc_diff( 0.125, 0.25 )
    );

  }
  public function test_array_value()
  {
    $this->assertEquals(
      '',
      Format::array_value( 'key', [] )
    );
    $this->assertEquals(
      '',
      Format::array_value( 'key2', ['key' => 'value'] )
    );
    $this->assertEquals(
      'value',
      Format::array_value( 'key', ['key' => 'value'] )
    );
  }
  public function test_kebabToPascal()
  {
    $this->assertEquals(
      'KebabToPascal',
      Format::kebabToPascal( 'kebab-to-pascal' )
    );
  }
  public function test_snakeToPascal()
  {
    $this->assertEquals(
      'SnakeToPascal',
      Format::snakeToPascal( 'snake_to_pascal' )
    );
  }
  public function test_snakeToCamel()
  {
    $this->assertEquals(
      'snakeToCamel',
      Format::snakeToCamel( 'snake_to_camel' )
    );
  }
  public function test_kebabToCamel()
  {
    $this->assertEquals(
      'kebabToCamel',
      Format::kebabToCamel( 'kebab-to-camel' )
    );
  }
  public function test_load_parse_file() {
    $this->assertEquals(
      'Hello World',
      Format::load_parse_file( 'tests/test-file.txt', ['name' => 'World'])
    );
    $this->expectException( \InvalidArgumentException::class );
    $this->assertEquals(
      'Hello World',
      Format::load_parse_file( 'tests/test-file.txt')
    );
  }

}

