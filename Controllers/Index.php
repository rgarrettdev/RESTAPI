<?php
class Index extends Controller
{
    public static function indexPage()
    {
        $webpage = new WebPage("Index", "Chi2019 Web API", "My footer");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("For more detail on the API, please go to documentation");
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");

        echo $webpage->getPage();
    }
}
