# G4rden

A minimalist PHP framework based on MVC pattern.

## Installation

- Install PHP 8.3
- Install MySQL
- Allow PHP PDO extension
- Create a database named `g4rden-db`
- Create an user named `g4rden-user` with password `g4rden-password`

## Conventions

- Folders: `snake_case`
- Files:
  - `SnakeCase.php` if it contains a class
  - `snake_case.php` for other files
- Classes: `PascalCase`
- Methods and functions: `camelCase()`
- Variables: `$snakeCase`
- Constants: `UPPER_SNAKE_CASE`

## Usage

The MVC pattern is base on an `index.php` file that loads the `router.php` file.

The `router.php` file finds the corresponding controller and executes it.

The controller communicates with a model if necessary, and the sends the view to the client.
