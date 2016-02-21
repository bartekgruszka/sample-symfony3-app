<?php

namespace TextAnalyzerBundle\TextAnalyzer;

class MostFrequentWordTextAnalyzer implements TextAnalyzer
{
    /**
     * @var string
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
        arsort($wordsCount);

        $highestFrequency = reset($wordsCount);
        $mostFrequentWords = array_keys($wordsCount, $highestFrequency);
        $this->result = implode(', ', $mostFrequentWords);
    }

    /**
     * @return string|mixed
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
        return 'most_frequent_word';
    }
}
