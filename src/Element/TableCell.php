<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class TableCell extends AbstractElement
{
    /**
     * 宽度
     * @var int
     */
    protected $colspan = 1;

    /**
     * content
     * @var string|ElementInterface
     */
    protected $content;

    /**
     * @return int
     */
    public function getColspan()
    {
        return $this->colspan;
    }

    /**
     * @return ElementInterface|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param int $colspan
     */
    public function setColspan($colspan)
    {
        $this->colspan = $colspan;
    }

    /**
     * @param ElementInterface|string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}