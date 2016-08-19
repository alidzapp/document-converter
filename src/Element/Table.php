<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class Table extends AbstractElement
{
    /**
     * @var TableCell[]
     */
    protected $cells;

    /**
     * @return TableCell[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param TableCell[] $cells
     */
    public function setCells($cells)
    {
        $this->cells = $cells;
    }
}