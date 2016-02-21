<?php

namespace Test\TextAnalyzerBundle\TextAnalyzer;

use TextAnalyzerBundle\TextAnalyzer\MostFrequentWordTextAnalyzer;

class MostFrequentWordTextAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new MostFrequentWordTextAnalyzer();
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
            ['', null],
            ['lorem', 'lorem'],
            ['lorem ipsum', 'ipsum, lorem'],
            ['lorem ipsum lorem', 'lorem'],
            ['lorem ipsum lorem ipsum lorem', 'lorem'],
            ['lorem ipsum dolor ipsum dolor lorem', 'dolor, ipsum, lorem']
        ];
    }
}
