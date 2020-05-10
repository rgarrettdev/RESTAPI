<?php
class About extends Controller
{
    public static function aboutIndex()
    {
        $webpage = new WebPage("About", "About", "Chi2019 Api");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Ryan Garrett ");
        $webpage->addToBody("w17019458");
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Web API");
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        echo $webpage->getPage();
    }
}
