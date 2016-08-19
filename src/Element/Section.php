<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class Section extends AbstractElement
{
    /**
     * @var ElementInterface[]
     */
    protected $elements;

    /**
     * @return ElementInterface[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param ElementInterface[] $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param ElementInterface $element
     */
    function addElement(ElementInterface $element)
    {
        $this->elements[] = $element;
    }
}