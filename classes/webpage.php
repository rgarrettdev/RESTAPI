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
<body class="d-flex flex-column min-vh-100">

PAGESTART;
    }

    private function makeCSS()
    {
        return "    <link
        rel='stylesheet'
        href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
      />";
    }

    private function makeHeader($pageHeading1)
    {
        return <<< HEADER
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/documentation/">Documentation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
            </ul>
        </nav>
        <div class='container p-4'>
        <h1 class='text-break'>$pageHeading1</h1>
        </div>
    </header>

HEADER;
    }

    private function makeMain($main)
    {
        return <<< MAIN
    <main>
        <div class='container p-4'>
        $main
        </div>
    </main>

MAIN;
    }

    private function makeFooter($footerText)
    {
        return <<< FOOTER
  <footer class='mt-auto text-center text-white bg-dark p-4'>
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
