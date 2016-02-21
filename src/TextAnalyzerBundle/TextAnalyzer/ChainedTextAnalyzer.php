<?php

namespace TextAnalyzerBundle\TextAnalyzer;

class ChainedTextAnalyzer implements TextAnalyzer
{
    /**
     * @var TextAnalyzer[]
     */
    protected $textAnalyzers = [];

    /**
     * @var array
     */
    protected $results;

    /**
     * @param TextAnalyzer[] $params
     */
    public function __construct(array $params)
    {
        $this->textAnalyzers = $params['text_analyzers'];
    }

    /**
     * @param string $text
     *
     * @return mixed
     */
    public function process($text)
    {
        foreach ($this->textAnalyzers as $textAnalyzer) {
            $textAnalyzer->process($text);
            $this->results[$textAnalyzer->getName()] = $textAnalyzer->getResult();
        }
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->results;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chained';
    }
}
