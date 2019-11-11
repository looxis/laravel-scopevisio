<?php

namespace Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice;

class ImportVariables
{
    /**
     * @var bool $generateDocumentNumbers
     */
    private $generateDocumentNumbers;

    /**
     * @var bool $doPost
     */
    private $doPost;

    /**
     * @var bool $skipDuplicates
     */
    private $skipDuplicates;

    /**
     * @var bool $createPdf
     */
    private $createPdf;

    /**
     * @var string $template
     */
    private $template;

    /**
     * @var bool $copyProductToPosition
     */
    private $copyProductToPosition;

    /**
     * @var bool $copyProductToPositionOverwriteMode
     */
    private $copyProductToPositionOverwriteMode;

    /**
     * @var bool $copyImpersonalAccountFieldsToPosition
     */
    private $copyImpersonalAccountFieldsToPosition;

    /**
     * ImportVariables constructor.
     */
    public function __construct()
    {
        $this->generateDocumentNumbers = false;
        $this->doPost = false;
        $this->skipDuplicates = false;
        $this->createPdf = false;
        $this->template = '';
        $this->copyProductToPosition = false;
        $this->copyProductToPositionOverwriteMode = false;
        $this->copyImpersonalAccountFieldsToPosition = false;
    }

    /**
     * @return bool
     */
    public function isGenerateDocumentNumbers(): bool
    {
        return $this->generateDocumentNumbers;
    }

    /**
     * @param bool $generateDocumentNumbers
     * @return ImportVariables
     */
    public function setGenerateDocumentNumbers(bool $generateDocumentNumbers): ImportVariables
    {
        $this->generateDocumentNumbers = $generateDocumentNumbers;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDoPost(): bool
    {
        return $this->doPost;
    }

    /**
     * @param bool $doPost
     * @return ImportVariables
     */
    public function setDoPost(bool $doPost): ImportVariables
    {
        $this->doPost = $doPost;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSkipDuplicates(): bool
    {
        return $this->skipDuplicates;
    }

    /**
     * @param bool $skipDuplicates
     * @return ImportVariables
     */
    public function setSkipDuplicates(bool $skipDuplicates): ImportVariables
    {
        $this->skipDuplicates = $skipDuplicates;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCreatePdf(): bool
    {
        return $this->createPdf;
    }

    /**
     * @param bool $createPdf
     * @return ImportVariables
     */
    public function setCreatePdf(bool $createPdf): ImportVariables
    {
        $this->createPdf = $createPdf;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return ImportVariables
     */
    public function setTemplate(string $template): ImportVariables
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyProductToPosition(): bool
    {
        return $this->copyProductToPosition;
    }

    /**
     * @param bool $copyProductToPosition
     * @return ImportVariables
     */
    public function setCopyProductToPosition(bool $copyProductToPosition): ImportVariables
    {
        $this->copyProductToPosition = $copyProductToPosition;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyProductToPositionOverwriteMode(): bool
    {
        return $this->copyProductToPositionOverwriteMode;
    }

    /**
     * @param bool $copyProductToPositionOverwriteMode
     * @return ImportVariables
     */
    public function setCopyProductToPositionOverwriteMode(bool $copyProductToPositionOverwriteMode): ImportVariables
    {
        $this->copyProductToPositionOverwriteMode = $copyProductToPositionOverwriteMode;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyImpersonalAccountFieldsToPosition(): bool
    {
        return $this->copyImpersonalAccountFieldsToPosition;
    }

    /**
     * @param bool $copyImpersonalAccountFieldsToPosition
     * @return ImportVariables
     */
    public function setCopyImpersonalAccountFieldsToPosition(bool $copyImpersonalAccountFieldsToPosition): ImportVariables
    {
        $this->copyImpersonalAccountFieldsToPosition = $copyImpersonalAccountFieldsToPosition;
        return $this;
    }

    public function toArray(): array
    {
        return [
            "generateDocumentNumbers" => $this->generateDocumentNumbers,
            "doPost" => $this->doPost,
            "skipDuplicates" => $this->skipDuplicates,
            "createPdf" => $this->createPdf,
            'template' => $this->template,
            "copyProductToPosition" => $this->copyProductToPosition,
            "copyProductToPositionOverwriteMode" => $this->copyProductToPositionOverwriteMode,
            "copyImpersonalAccountFieldsToPosition" => $this->copyImpersonalAccountFieldsToPosition
        ];
    }
}
