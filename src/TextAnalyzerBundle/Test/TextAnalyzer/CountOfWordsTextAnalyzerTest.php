<?php

namespace Test\TextAnalyzerBundle\TextAnalyzer;

use TextAnalyzerBundle\TextAnalyzer\CountOfWordsTextAnalyzer;

class CountOfWordsTextAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new CountOfWordsTextAnalyzer();
    }

    /**
     * @dataProvider textProvider
     */
    public function testTextAnalyzer($actualText, $expectedResult)
    {
        $this->object->process($actualText);

        $this->assertEquals($expectedResult, $this->object->getResult());
    }

    public function textProvider()
    {
        return [
            ['', 0],
            ['lorem', 1],
            ['lorem ipsum', 2],
            ['lorem ipsum lorem', 3]
        ];
    }
}
