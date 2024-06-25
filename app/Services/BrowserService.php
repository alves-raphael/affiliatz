<?php

namespace App\Services;
use HeadlessChromium\Browser\ProcessAwareBrowser;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;

class BrowserService
{
    private Page $page;
    private ProcessAwareBrowser $browser;
    public function __construct(
         BrowserFactory $browserFactory
    ) {
        $browserFactory->addOptions(['enableImages' => false, 'noSandbox' => true]);
        $this->browser = $browserFactory->createBrowser();
        $this->page = $this->browser->createPage();
    }

    public function read(string $url)
    {
        try {
            $this->page->navigate($url)->waitForNavigation();
            return $this->page->evaluate('document.body.innerHTML')->getReturnValue();
        } finally {
            $this->browser->close();
        }
    }
}
