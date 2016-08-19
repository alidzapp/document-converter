<?php
/**
 * Slince Document Converter Library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\DocumentConverter;

class Page extends AbstractElement
{
    /**
     * @var Section[]
     */
    protected $sections;

    /**
     * @param Section[] $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    /**
     * @return Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param Section $section
     */
    public function addSection(Section $section)
    {
        $this->sections[] = $section;
    }

    /**
     * 创建一个章节
     * @return Section
     */
    function makeSection()
    {
        $section = new Section();
        $this->addSection($section);
        return $section;
    }
}