<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter\Parser;

use Slince\DocumentConverter\DocumentInterface;

interface ParserInterface
{
    /**
     * 解析文件
     * @param $file
     * @return DocumentInterface
     */
    function parse($file);
}