<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter\Exporter;

use Slince\DocumentConverter\DocumentInterface;

interface ExporterInterface
{
    /**
     * 将document导出到文件
     * @param DocumentInterface $document
     * @return boolean
     */
    function export(DocumentInterface $document);
}