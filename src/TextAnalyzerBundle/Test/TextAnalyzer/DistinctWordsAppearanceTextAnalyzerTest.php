<?php

namespace Test\TextAnalyzerBundle\TextAnalyzer;

use TextAnalyzerBundle\TextAnalyzer\DistinctWordsAppearanceTextAnalyzer;

class DistinctWordsAppearanceTextAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new DistinctWordsAppearanceTextAnalyzer();
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
            ['', []],
            ['lorem', ['lorem' => 1]],
            ['lorem ipsum', ['lorem' => 1, 'ipsum' => 1]],
            ['lorem ipsum lorem', ['lorem' => 2, 'ipsum' => 1]],
            ['lorem ipsum lorem ipsum', ['lorem' => 2, 'ipsum' => 2]],
            ['lorem ipsum dolor lorem ipsum', ['lorem' => 2, 'ipsum' => 2, 'dolor' => 1]]
        ];
    }
}
