<?php

namespace TextAnalyzerBundle\TextAnalyzer;

class CountOfWordsTextAnalyzer implements TextAnalyzer
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
        $this->result = str_word_count($text);
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
        return 'count_of_words';
    }
}
