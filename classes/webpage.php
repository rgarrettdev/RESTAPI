<?php
    
class WebPage
{
    private $pageStart;
    private $header;
    private $main;
    private $footer;
    private $pageEnd;

    public function __construct($pageTitle, $pageHeading1, $footerText)
    {
        $this->pageStart = $this->makePageStart($pageTitle);
        $this->header = $this->makeHeader($pageHeading1);
        $this->main = "";
        $this->footer = $this->makeFooter($footerText);
        $this->pageEnd = $this->makePageEnd();
    }

    private function makePageStart($pageTitle)
    {
        $mycss = $this->makeCSS();

        return <<< PAGESTART
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  	<title>$pageTitle</title>
  	$mycss 
</head>
<body>

PAGESTART;
    }

    private function makeCSS()
    {
        return "";
    }

    private function makeHeader($pageHeading1)
    {
        return <<< HEADER
    <header>
        <h1>$pageHeading1</h1>
    </header>

HEADER;
    }

    private function makeMain($main)
    {
        return <<< MAIN
    <main>
        $main
    </main>

MAIN;
    }

    private function makeFooter($footerText)
    {
        return <<< FOOTER
  <footer>
  	$footerText
  </footer>

FOOTER;
    }

    private function makeJS()
    {
        return "";
    }

    private function makePageEnd()
    {
        $myJS = $this->makeJS();
        return <<< PAGEEND
 $myJS
 </body>
</html>

PAGEEND;
    }

    public function addToBody($text)
    {
        $this->main .= $text;
    }

    public function getPage()
    {
        $this->main = $this->makeMain($this->main);

        return 	$this->pageStart.
                $this->header.
                $this->main.
                $this->footer.
                $this->pageEnd;
    }
}
