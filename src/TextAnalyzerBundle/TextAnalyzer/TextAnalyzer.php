<?php

namespace TextAnalyzerBundle\TextAnalyzer;

interface TextAnalyzer
{
    /**
     * @param string $text
     *
     * @return mixed
     */
    public function process($text);

    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @return string
     */
    public function getName();
}
