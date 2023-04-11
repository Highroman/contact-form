# contact-form
Réalisation du test technique PHP/Symfony
Contact Form API
This API provides CRUD (Create, Read, Update, Delete) operations for a contact form.

Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

Prerequisites
PHP 7.4 or higher
Composer
Installing
Clone the repository: git clone https://github.com/Highroman/contact-form.git
Navigate into the project directory: cd contact-form
Checkout the rest branch: git checkout rest
Install dependencies: composer install
Start the development server: symfony server:start
API Endpoints
GET /api/contacts
Retrieve a list of all contacts.

GET /api/contacts/{id}
Retrieve a specific contact by ID.

POST /api/contacts
Create a new contact.

Request Body:

perl
Copy code
{
    "firstName": "John",
    "lastName": "Doe",
    "email": "john.doe@example.com",
    "message": "Hello, this is a test message.",
    "department": 1
}
PUT /api/contacts/{id}
Update an existing contact.

Request Body:

perl
Copy code
{
    "firstName": "John",
    "lastName": "Doe",
    "email": "john.doe@example.com",
    "message": "Hello, this is an updated test message.",
    "department": 1
}
DELETE /api/contacts/{id}
Delete an existing contact.

Built With
Symfony 5.4
Doctrine ORM
Composer
