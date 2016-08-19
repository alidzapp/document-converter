<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class Header extends TextBlock
{
    /**
     * 所属的上一级Header
     * @var Header
     */
    protected $parentHeader;

    /**
     * Level等级
     * @var int
     */
    protected $level;
}