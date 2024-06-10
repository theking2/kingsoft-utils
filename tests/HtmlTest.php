<?php declare(strict_types=1);
use \Kingsoft\Utils\Html;
class HtmlTest extends \PHPUnit\Framework\TestCase
{
  const REQUEST = ['param1'=>"", 'param2'=>"" ];
  public function test_checkParam()
  {
    // all parameters should match
    $this->assertTrue(
      Html::checkParams(
        ['param1', 'param2' ],
        self::REQUEST, true, false
      )
    );
    // request contains more parameters, which is ok for not exact
    $this->assertTrue(
      Html::checkParams(
        ['param2' ],
        self::REQUEST,
        false,
        false
      )
    );
    // parameter missing in request
    $this->assertFalse(
      Html::checkParams(
        ['param1', 'param2', 'param3' ],
        self::REQUEST,
        true,
        false
      )
    );
    // equal number but one spelled different
    $this->assertFalse(
      Html::checkParams(
        ['param1', 'param3' ],
        self::REQUEST, true, false
      )
    );
    // Non exact but missing parameter
    $this->assertFalse(
      Html::checkParams(
        ['param3' ],
        self::REQUEST,
        false,
        false
      )
    );
  }
  public function test_wrap_tag()
  {
    $this->assertEquals(
      '<div>content</div>',
      Html::wrap_tag('div', 'content')
    );
  }
  public function test_base64url_encode()
  {
    $this->assertEquals(
      'aGVsbG8gd29ybGQ',
      Html::base64url_encode('hello world')
    );
  }
  public function test_base64url_decode()
  {
    $this->assertEquals(
      'hello world',
      Html::base64url_decode('aGVsbG8gd29ybGQ')
    );
  }
  public function test_check_request_params()
  {
    $_REQUEST = self::REQUEST;
    $this->assertFalse(
      Html::check_request_params(
        ['param1', 'param2' ],
        false
      )
    );
    $this->assertFalse(
      Html::check_request_params(
        ['param2' ],
        false
      )
    );
    $this->assertTrue(
      Html::check_request_params(
        ['param1', 'param2', 'param3' ],
        false
      )
    );
    $this->assertTrue(
      Html::check_request_params(
        ['param1', 'param3' ],
        false
      )
    );
    $this->assertTrue(
      Html::check_request_params(
        ['param3' ],
        false
      )
    );
  }
  public function test_option_tag()
  {
    $this->assertEquals(
      '<option value="value">content</option>' . PHP_EOL,
      Html::option_tag('content', 'value', 'value2')
    );
    $this->assertEquals(
      '<option selected value="value">content</option>' . PHP_EOL,
      Html::option_tag('content', 'value', 'value')
    );
  }
}