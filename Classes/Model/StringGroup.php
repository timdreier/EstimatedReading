<?php
namespace TimDreier\TdReadingTime\Model;

use TimDreier\TdReadingTime\Service\StringService;

/**
 * Model for temporary Collection of String Information
 */
class StringGroup
{
    /**
     * @var int
     */
    protected $chars = 0;

    /**
     * @var int
     */
    protected $charsWithoutSpaces = 0;

    /**
     * @var int
     */
    protected $words = 0;

    /**
     * @var int
     */
    protected $sentences = 0;

    /**
     * @var int
     */
    protected $totalSeconds = 0;

    /**
     * function __construct
     *
     * @param string $string
     * @return StringGroup
     */
    public function __construct(string $string)
    {
        $this->addString($string);
    }

    /**
     * Adds string to local object
     *
     * @param string $string
     */
    public function addString(string $string)
    {
        $tmp = StringService::fetchStatistics($string);
        $this->chars = $tmp['chars'];
        $this->words = $tmp['words'];
        $this->charsWithoutSpaces = $tmp['charsWithoutSpaces'];
        $this->sentences = $tmp['sentences'];
        $this->rebuildTdReadingTime();
    }

    /**
     * function getChars
     * returns the number of chars
     *
     * @return int
     */
    public function getChars()
    {
        return $this->chars;
    }

    /**
     * function getWords
     * returns the number of words
     *
     * @return int
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * function getCharsWithoutSpaces
     * returns the number of chars without spaces
     *
     * @return int
     */
    public function getCharsWithoutSpaces()
    {
        return $this->charsWithoutSpaces;
    }

    /**
     * function getSentences
     * returns the number of sentences
     *
     * @return int
     */
    public function getSentences()
    {
        return $this->sentences;
    }

    /**
     * function rebuildTdReadingTime
     * recalculates the needed amount of seconds
     */
    public function rebuildTdReadingTime()
    {
        $tmp = $this->getWords();
        $tmp = $tmp / 200;
        $minutes = (int) $tmp;
        $seconds =  (int)(60 * ($tmp - $minutes));
        $this->totalSeconds = 60 * $minutes + $seconds;
    }

    /**
     * @return int
     */
    public function getTotalSeconds()
    {
        return $this->totalSeconds;
    }

    /**
     * function getSeconds
     * Returns the amount of seconds for H:i:s ( 01:30:05 would be 5 )
     *
     * @return int
     */
    public function getSeconds()
    {
        return $this->totalSeconds
                - $this->getHours() * 60 * 60
                - $this->getMinutes() * 60;
    }

    /**
     * function getHours
     * Calculates the amount of hours ( 93 minutes would be 1 )
     *
     * @return int
     */
    public function getHours()
    {
        return (int)($this->totalSeconds / 60 / 60);
    }

    /**
     * function getMinutes
     * Calculates the amount of minutes for H:i:s ( 93 Minutes would be 33 )
     *
     * @return int
     */
    public function getMinutes()
    {
        return (int)(($this->totalSeconds - $this->getHours() * 60 * 60) / 60);
    }

    /**
     * function getRoundedMinutes
     * Calculates the total rounded amount of minutes ( 93 minutes and 42 seconds would be 34 )
     *
     * @return int
     */
    public function getRoundedMinutes()
    {
        if ($this->getSeconds() >= 30) {
            return $this->getMinutes() + 1;
        }
        return $this->getMinutes();
    }

    /**
     * function getTotalMinutes
     * Calculates the total amount of minutes ( 1,5h would be 90min )
     *
     * @return int
     */
    public function getTotalMinutes()
    {
        return (int)($this->totalSeconds / 60);
    }
}
