<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class TextBlock
{
    /**
     * 文本内容
     * @var string
     */
    protected $textPlain;

    /**
     * @param mixed $textPlain
     */
    public function setTextPlain($textPlain)
    {
        $this->textPlain = $textPlain;
    }

    /**
     * @return mixed
     */
    public function getTextPlain()
    {
        return $this->textPlain;
    }
}