<?php

class Documentation extends Controller
{
    /**
     * Set id of specfic endpoint documentation.
     */
    public static function docIndex()
    {
        $webpage = new WebPage("Documentation", "Endpoints", "Chi2019 Api");
        $webpage->addToBody("<ul>");
        $webpage->addToBody("<li><a href='/documentation/1'>/api/schedule/</a></li>");
        $webpage->addToBody("<li><a href='/documentation/2'>/api/schedule/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/3'>/api/schedule/update/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/4'>/api/presentations/</a></li>");
        $webpage->addToBody("<li><a href='/documentation/5'>/api/presentations/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/6'>/api/presentations/category/:categoryname</a></li>");
        $webpage->addToBody("<li><a href='/documentation/7'>/api/presentations/search/:searchterm</a></li>");
        $webpage->addToBody("<li><a href='/documentation/8'>/api/presentations/advanced/:searchterm/:categoryname</a></li>");
        $webpage->addToBody("<li><a href='/documentation/9'>/api/login</a></li>");
        $webpage->addToBody("<li><a href='/documentation/10'>/api/logout</a></li>");
        $webpage->addToBody("</ul>");
        echo $webpage->getPage();
    }
    /**
     * A generic component, to build the endpoint information page.
     * The data describing the endpoints are found in the Views/Documentation.php
     */
    public static function docEndpoint($endpoint, $request, $result, $info)
    {
        $webpage = new WebPage("Documentation", $endpoint, "Chi2019 Api");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Request: ");
        $webpage->addToBody("<a href='$request'>");
        $webpage->addToBody($request);
        $webpage->addToBody('</a>');
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<pre>');
        $webpage->addToBody("Expected result: ");
        $webpage->addToBody($result);
        $webpage->addToBody('</pre>');
        $webpage->addToBody("</div>");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Additional Information: ");
        $webpage->addToBody($info);
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        echo $webpage->getPage();
    }
    /**
     * Controls what endpoint data is shown in the Views/Documentation.php
     * This is called within the documentation view.
     */
    public static function checkEndpoint()
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        $path = explode("/", $path);

        return $path[2];
    }
}
