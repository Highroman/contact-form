# Contact Form

This project is a simple contact form built with Symfony 5. It allows users to send a message to the website owner by filling out a form. The message is then stored in a MySQL database and can be viewed and managed by an admin user.

## Features
- Online contact form with server-side validation
- Sending data from the form to a specified email address

## Technologies used
- PHP 7.4.1
- Symfony 5.3 (PHP)
- Bootstrap 5 (CSS/JS)
- Mailer (sending emails)
- Doctrine

## Production

The application is currently deployed on Heroku and can be accessed at https://contact-form-roman-bajine.herokuapp.com/fiche-contact.

## Installation

To install the application, follow these steps:

1. Clone the repository: `git clone https://github.com/your-username/contact-form.git`
2. Install the dependencies: `composer install`
3. Configure the database connection in `.env`
4. Create the database: `php bin/console doctrine:database:create`
5. Run the migrations: `php bin/console doctrine:migrations:migrate`
6. Load the fixtures: `php bin/console doctrine:fixtures:load`

## Usage

To use the application, simply access the URL where it is deployed and fill out the contact form.

## Contributing

Contributions are welcome! If you would like to contribute, please open a pull request or an issue.
