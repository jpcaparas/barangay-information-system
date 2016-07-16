<?php

namespace BIS\CMSBundle\DependencyInjection\PHPWord;

use PhpOffice\PhpWord\Exception\Exception;

class ClearanceProcessorException extends Exception {}

class ClearanceProcessor extends TemplateProcessor {
    protected $clearanceDir;
    protected $clearanceOutputDir;
    protected $clearanceTemplateDir;
    protected $clearanceTemplateFilename;
    protected $clearanceOutputFilename;

    protected $namePlaceholder;
    protected $datePlaceholder;
    protected $photoPlaceholder;

    public function __construct(array $params = array()) {
        $defaults = array(
            'clearanceDir' => __DIR__ . '/resources',
            'clearanceTemplateDir' => 'templates',
            'clearanceTemplateFilename' => 'clearance.docx',
            'clearanceOutputDir' => 'output',
            'clearanceOutputFilename' => 'clearance.docx',
            'namePlaceholder' => '{{NAME}}',
            'datePlaceholder' => '{{DATE}}',
            'photoPlaceholder' => 'image1.png',
        );


        foreach (array_keys($defaults) as $key) {
            $this->$key = empty($params[$key]) ? $defaults[$key] : $params[$key];
        }

        $this->checkClearanceDirectoryAndFileExistence();

        parent::__construct($this->getClearanceTemplatePath());
    }

    protected function checkClearanceDirectoryAndFileExistence() {
        $dirs = array(
            'templateDir' => $this->clearanceDir . '/' . $this->clearanceTemplateDir,
            'outputDir' => $this->clearanceDir . '/' . $this->clearanceOutputDir
        );

        foreach($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        if (!file_exists($this->getClearanceTemplatePath())) {
            throw new ClearanceProcessorException('The clearance template file, ' . $this->getClearanceTemplatePath() . ', does not exist.');
        }
    }

    public function getClearanceTemplatePath() {
        return $this->clearanceDir . '/' . $this->clearanceTemplateDir . '/' . $this->clearanceTemplateFilename;
    }

    public function getClearanceOutputPath() {
        return $this->clearanceDir . '/' . $this->clearanceOutputDir . '/' . $this->clearanceOutputFilename;
    }

    public function setName($name = null) {
        $this->setValue($this->namePlaceholder, $name);
        return $this;
    }

    public function setPhoto($replacementPhoto = null) {
        $this->setImageValue($this->photoPlaceholder, $replacementPhoto);
        return $this;
    }

    public function setDate($date = null) {
        $this->setValue($this->datePlaceholder, $date);
        return $this;
    }

    public function saveNow() {
        $this->saveAs($this->getClearanceOutputPath());
        return $this;
    }
}