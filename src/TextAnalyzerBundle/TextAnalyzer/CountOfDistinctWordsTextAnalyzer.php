<?php

namespace TextAnalyzerBundle\TextAnalyzer;

class CountOfDistinctWordsTextAnalyzer implements TextAnalyzer
{
    /**
     * @var int
     */
    protected $result;

    /**
     * @param string $text
     *
     * @return mixed
     */
    public function process($text)
    {
        $text = mb_strtolower($text);
        $wordsList = str_word_count($text, 1);
        $distinctWordsList = array_unique($wordsList);
        $this->result = count($distinctWordsList);
    }

    /**
     * @return int|mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'count_of_distinct_words';
    }
}
