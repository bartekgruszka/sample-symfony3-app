<?php

namespace Test\TextAnalyzerBundle\TextAnalyzer;

use TextAnalyzerBundle\TextAnalyzer\ChainedTextAnalyzer;
use TextAnalyzerBundle\TextAnalyzer\CountOfDistinctWordsTextAnalyzer;
use TextAnalyzerBundle\TextAnalyzer\CountOfWordsTextAnalyzer;
use TextAnalyzerBundle\TextAnalyzer\DistinctWordsAppearanceTextAnalyzer;
use TextAnalyzerBundle\TextAnalyzer\MostFrequentWordTextAnalyzer;

class ChainedTextAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $params['text_analyzers'] = [];

        $params['text_analyzers'][] =
            $this->getMockOfCountOfDistinctWordsTextAnalyzer();

        $params['text_analyzers'][] =
            $this->getMockOfCountOfWordsTextAnalyzer();

        $params['text_analyzers'][] =
            $this->getMockOfDistinctWordsAppearanceTextAnalyzer();

        $params['text_analyzers'][] =
            $this->getMockOfMostFrequentWordTextAnalyzerTest();

        $this->object = new ChainedTextAnalyzer($params);
    }

    public function testTextAnalyzer()
    {
        $this->object->process('lorem ipsum lorem');

        $actualResult = $this->object->getResult();

        $expectedResult = [
            'count_of_distinct_words' => 2,
            'count_of_words' => 3,
            'distinct_words_appearance' => ['lorem' => 2, 'ipsum' => 1],
            'most_frequent_word' => 'lorem'
        ];

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockOfCountOfDistinctWordsTextAnalyzer()
    {
        $mock = $this->getMockBuilder(CountOfDistinctWordsTextAnalyzer::class)
            ->getMock();

        $mock->method('getName')->willReturn('count_of_distinct_words');
        $mock->method('getResult')->willReturn(2);

        return $mock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockOfCountOfWordsTextAnalyzer()
    {
        $mock = $this->getMockBuilder(CountOfWordsTextAnalyzer::class)
            ->getMock();

        $mock->method('getName')->willReturn('count_of_words');
        $mock->method('getResult')->willReturn(3);

        return $mock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockOfDistinctWordsAppearanceTextAnalyzer()
    {
        $mock = $this->getMockBuilder(DistinctWordsAppearanceTextAnalyzer::class)
            ->getMock();

        $mock->method('getName')->willReturn('distinct_words_appearance');
        $mock->method('getResult')->willReturn(['lorem' => 2, 'ipsum' => 1]);

        return $mock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockOfMostFrequentWordTextAnalyzerTest()
    {
        $mock = $this->getMockBuilder(MostFrequentWordTextAnalyzer::class)
            ->getMock();

        $mock->method('getName')->willReturn('most_frequent_word');
        $mock->method('getResult')->willReturn('lorem');

        return $mock;
    }
}

