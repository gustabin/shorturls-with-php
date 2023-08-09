# URL Shortener App

This is a simple URL shortener application built using HTML, CSS, JavaScript, and PHP. It allows you to shorten long URLs into shorter, more manageable links.

## Features

- Shorten any long URL into a unique short link.
- Copy the short link to your clipboard with a single click.
- Easily navigate to the original long URL by clicking on the short link.

## Getting Started

1. Clone or download this repository to your local machine.

2. Configure your local environment:
   - Make sure you have a web server (e.g., Apache) and PHP installed.
   - Import the provided SQL schema to set up the database for storing short URLs.

3. Edit the `api.php` file:
   - Adjust the database connection settings to match your local environment.

4. Open the `index.php` file in your web browser and start using the URL shortener.

## Code Structure

- `index.php`: Main webpage containing the URL shortener form and result display.
- `api.php`: API endpoint for creating short URLs and responding with JSON data.
- `get_long_url.php`: API endpoint for redirecting short URLs to their original long URLs.

## Dependencies

- [Bootstrap](https://getbootstrap.com/): CSS framework for styling the webpage.
- [Font Awesome](https://fontawesome.com/): Icons for a better user experience.
- [jQuery](https://jquery.com/): JavaScript library for handling DOM manipulation.
  
## Contributors

- Developed by [Gustavo Arias](mailto:gustavoarias@outlook.com)

## License

This project is licensed under the [MIT License](LICENSE).
