# RESTAPI
List of all supported endpoints.
## Supported Endpoints

Base url = `localhost`\

 `/api/schedule/`\
 `/api/schedule/:session`\
 `/api/schedule/update/:id`\
 `/api/presentations/`\
 `/api/presentations/:id`\
 `/api/presentations/search/:searchterm`\
 `/api/presentations/search/:searchterm/:categoryname`\
 `/api/presentations/category/:categoryname`\
 `/api/login`\
 `/api/logout`

### Read more detail through the documentation
Found at the documentation endpoint. \
`localhost/documentation/`

### Setup
Xampp setup in httpd.conf \
`Listen Port: 80`\
`Set the DocumentRoot to point to the local-html folder`

Front-end setup \
Once xampp has been configured above. \
To access the front end and have full functionality, please use: \
`localhost/FrontEnd/`

#### Extra details

API is bult with the MVC pattern in mind, autoloader is found in index.php \
Controllers handle all the data that the views display. \