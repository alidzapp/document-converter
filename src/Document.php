<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class Document implements DocumentInterface
{
    protected $summary;

    function getSummary()
    {
        return $this->summary;
    }
}