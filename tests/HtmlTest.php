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
      \Kingsoft\Utils\Html::checkParams(
        ['param1', 'param3' ],
        self::REQUEST, true, false
      )
    );
    // Non exact but missing parameter
    $this->assertFalse(
      \Kingsoft\Utils\Html::checkParams(
        ['param3' ],
        self::REQUEST,
        false,
        false
      )
    );
  }
}