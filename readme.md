# G4rden

A minimalist PHP framework based on MVC pattern.

## Installation

1. Programs

- Install PHP 8.3
- Install MySQL

1. PHP Config (for Windows)

- Allow `PHP PDO extension` :
  - Find your PHP installation directory
  - Rename `pdo.ini-development` to `pdo.ini`
  - Open `pdo.ini`: uncomment `extension=pdo_mysql` and `extension_dir = "ext"`

1. Database

- Create a database and an user with privileges (follow `/sql/database.sql`)
- Add tables (follow `/sql/tables.sql`)
- Insert data into tables (follow `/sql/data.sql`)

1. Files

- Add an `.env` file with the following content:

```
# Environnement setup
ENV=DEV

# MySQL Database
MYSQL_HOST=localhost
MYSQL_NAME=g4rden-db
MYSQL_USER=g4rden-user
MYSQL_PASS=g4rden-password
```

1. Run the project

```
php -S localhost:8000
```

## Production

1. Alwaysdata

- Create an account
- Create a website
- In SFTP settings, allow and add a password

1. Install SFTP extension

- Create a folder `.vscode`
- Create a file `.vscode/settings.json` with the following content:

```
{
  "name": "G4rden",
  "host": "ssh-your-username.alwaysdata.net",
  "protocol": "sftp",
  "port": 22,
  "username": "your-username",
  "password": "your-password",
  "remotePath": "/home/your-username/www/",
  "uploadOnSave": true,
  "ignore": [
      "**/.vscode/**",
      "**/.git/**",
      "**/.DS_Store",
      "**/.env"
  ]
}
```
- Launch `SFTP: Sync Local -> Remote`


## Conventions

- Folders: `snake_case`
- Files:
  - `SnakeCase.php` if it contains a class
  - `snake_case.php` for other files
- Classes: `PascalCase`
- Methods and functions: `camelCase()`
- Variables: `$camelCase`
- Constants: `UPPER_SNAKE_CASE`

## Usage

The MVC pattern is base on an `index.php` file that loads the `router.php` file.

The `router.php` file finds the corresponding controller and executes it.

The controller communicates with a model if necessary, and the sends the view to the client.


## Branch and commits

- Branch:
    - new feature: `feature/new-feature-name`
    - bug fix: `fix/fix-bug-description`

- Commits:
    - feature: `feat: new feature`
    - fix: `fix: fix bug`