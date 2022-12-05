<?php

declare(strict_types=1);

namespace FW\Core;

class App
{
    const TEMPLATE_ID = 'template/id';
    const FILE_HEADER = '/header.php';
    const FILE_FOOTER = '/footer.php';

    private bool $isBufferStart = false;

    private ?Page $pager = null;

    private $template = null;

    public function __construct()
    {
        $this->pager = InstanceContainer::get(Page::class);
    }

    public function header(): void
    {
        $this->startBuffer();
        include ROOT_TEMLATES . Config::get(self::TEMPLATE_ID) . self::FILE_HEADER;
    }


    public function footer()
    {
        include ROOT_TEMLATES . Config::get(self::TEMPLATE_ID) . self::FILE_FOOTER;
        $content = $this->endBuffer();

        echo $content;
    }

    private function startBuffer(): void
    {
        ob_start();
        $this->isBufferStart = true;
    }

    private function endBuffer()
    {
        $content = ob_get_clean();
        $this->isBufferStart = false;
        $replaces = $this->pager->getAllReplace();
        $content = str_replace(array_keys($replaces), $replaces, $content);

        return $content;
    }

    public function restartBuffer(): void
    {
        if ($this->isBufferStart === true) {
            ob_clean();
        } else {
            $this->startBuffer();
        }
    }

    public function getPage(): Page
    {
        return $this->pager;
    }
}