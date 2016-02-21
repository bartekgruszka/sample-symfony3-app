<?php

namespace TextAnalyzerBundle\TextAnalyzer;

class DistinctWordsAppearanceTextAnalyzer implements TextAnalyzer
{
    /**
     * @var array
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
        $wordsCount = array_count_values($wordsList);
        ksort($wordsCount);
        $this->result = $wordsCount;
    }

    /**
     * @return array|mixed
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
        return 'distinct_words_appearance';
    }
}
