<?php

class Documentation extends Controller
{
    public static function docIndex()
    {
        $webpage = new WebPage("Documentation", "Endpoints", "My footer");
        $webpage->addToBody("<ul>");
        $webpage->addToBody("<li><a href='/documentation/1'>/api/schedule/</a></li>");
        $webpage->addToBody("<li><a href='/documentation/2'>/api/schedule/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/3'>/api/schedule/update/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/4'>/api/presentations/</a></li>");
        $webpage->addToBody("<li><a href='/documentation/5'>/api/presentations/:id</a></li>");
        $webpage->addToBody("<li><a href='/documentation/6'>/api/presentations/category/:categoryname</a></li>");
        $webpage->addToBody("<li><a href='/documentation/7'>/api/presentations/search/:searchterm</a></li>");
        $webpage->addToBody("<li><a href='/documentation/8'>/api/presentations/search/:searchterm/:categoryname`</a></li>");
        $webpage->addToBody("<li><a href='/documentation/9'>/api/login/</a></li>");
        $webpage->addToBody("<li><a href='/documentation/10'>/api/logout</a></li>");
        $webpage->addToBody("</ul>");
        echo $webpage->getPage();
    }
    public static function docEndpoint($endpoint, $request, $result)
    {
        $webpage = new WebPage("Documentation", $endpoint, "My footer");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Request: ");
        $webpage->addToBody($request);
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        $webpage->addToBody("<div>");
        $webpage->addToBody('<p>');
        $webpage->addToBody("Expected result: ");
        $webpage->addToBody($result);
        $webpage->addToBody('</p>');
        $webpage->addToBody("</div>");
        echo $webpage->getPage();
    }

    public static function checkEndpoint()
    {
        if ($_GET['api'] == null) {
            return null;
        } elseif ($_GET['api'] == 1) {
            return 1;
        } elseif ($_GET['api'] == 2) {
            return 2;
        } elseif ($_GET['api'] == 3) {
            return 3;
        } elseif ($_GET['api'] == 4) {
            return 4;
        } elseif ($_GET['api'] == 5) {
            return 5;
        } elseif ($_GET['api'] == 6) {
            return 6;
        } elseif ($_GET['api'] == 7) {
            return 7;
        } elseif ($_GET['api'] == 8) {
            return 8;
        } elseif ($_GET['api'] == 9) {
            return 9;
        } elseif ($_GET['api'] == 10) {
            return 10;
        }
    }
}
