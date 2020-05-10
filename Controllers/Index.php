<?php
class Index extends Controller
{
    public static function indexPage()
    {
        $webpage = new WebPage("Index", "Chi2019 Web API", "Chi2019 Api");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("For more detail on the API, please go to");
        $webpage->addToBody('<a href="/documentation/"> documentation.</a>');
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");

        echo $webpage->getPage();
    }
}
