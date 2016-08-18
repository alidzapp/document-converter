<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter\Parser;

use Slince\DocumentConverter\Document;
use Slince\DocumentConverter\DocumentInterface;

class MarkdownParser implements ParserInterface
{
    function parse($file)
    {
        $document = new Document();
    }
}