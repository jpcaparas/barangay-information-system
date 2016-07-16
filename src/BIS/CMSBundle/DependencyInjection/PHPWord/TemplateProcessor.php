<?php

namespace BIS\CMSBundle\DependencyInjection\PHPWord;

class TemplateProcessor extends \PhpOffice\PhpWord\TemplateProcessor {
    /**
     * Replace image
     *
     * @param string $search
     * @param string $replace
     * @return boolean
     */
    public function setImageValue($search, $replace)
    {
        // Sanity check
        if (!file_exists($replace))
        {
            return false;
        }

        // Delete current image
        $this->zipClass->deleteName('word/media/' . $search);

        // Add a new one
        $this->zipClass->addFile($replace, 'word/media/' . $search);

        return true;
    }
}