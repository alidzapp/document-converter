<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

interface DocumentInterface
{
    function getSummary();

    function getAuthor();

    function getCreateTime();

    function getModifyTime();

    function getMimeType();

    function getContent();
}