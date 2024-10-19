# Todo

## Navigation

- [x] Dark mode button to fix

## Auth

- [x] Add a feedback for users if register ou login fails
- [x] Fix session issue when registering

- [x] Add feedback for user
  - [x] Login/Register failed
  - [x] Send message failed
  - [x] Send subject failed

## Add message

- [ ] Charge 10 more messages when reaching the top of the chat
- [x] Display date and time in French

## Model

- [x] Instantiate a class with `$myModel = new Model();` and fill it with `myModel->myMethodById($id);`
- [x] Update model subject

## Database

- [ ] Add `email` column to `User` table
- [ ] Make `email` and `username` constraints unique
- [x] Rename `id` to `userId` in `User` table
- [x] Rename `id` to `messageId` in `Message` table
- [x] Create table `Subject` and its `model`
- [x] Check database insert validated by `htmlspecialchars`

## Errors

- [ ] DEV environment

  - [x] Check models errors works
  - [x] Check controllers errors works
  - [ ] Check async errors works
  - [x] Check login/register

- [x] PROD environment

  - [x] Check "Something went wrong" page works
  - [x] Check "Page not found" page works
  
- [x] FEEDBACKS for user
  
  - [x] Login/Register failed
  - [x] Send message failed
  - [x] Send subject failed

## Projets

My ideas for the project (Nans):

- [x] Dark mode
- [x] `Home page` with links to each pages (Subjects, Messages, Login...)
- [x] General chat in `Message page`
- [x] Create one page for each `subject` with based on `messages`
- [ ] Display subjects in a `Subject page` with filters, search bar...
- [ ] `REGEX` validation for inputs

### [Minimalist forum](https://mickael-martin-nevot.com/institut-g4/php/?:s11-projet.pdf)

- [ ] Add `email` field to register and login

- [x] `forum.php` CONTAINS

  - [x] A login form that sends a POST request to `login.php`
  - [x] A register form that sends a POST request to `register.php`

- [ ] `register.php` PROCESS

  - [x] Check if $_POST contains every required fields, else send a `feedback to the client`
  - [ ] Check if password hardness with `regex`, else send a `feedback to the client`
  - [x] Check if password and confirm password are the same, else send a `feedback to the client`
  - [x] Check if `email` is not already used, else send a `feedback to the client`
  - [x] Insert the new user in the database
  - [ ] Send an email to the user to send to advertise him/her (Nans : "Maybe not profitable enough for us to do it, but very interesting for security if we add an email verification link")
  - [x] Start session (or set an `active` session variable)
  - [x] Add user data to session (`id`, `email`, `username`, `firstname`, `lastname`, `userType`...)
  - [x] Redirection to a login protected page

- [ ] `login.php` PROCESS

  - [x] Check if $_POST contains `email` and `password`, else send a `feedback to the client`
  - [x] Check if user exists in database, else send a `feedback to the client`
  - [x] Check if credentials are correct, else send a `feedback to the client`
  - [x] Start session (or set an `active` session variable)
  - [x] Add user data to session (`id`, `email`, `username`, `firstname`, `lastname`, `userType`...)
  - [x] Redirection to a login protected page

- [x] `list-post.php` CONTAINS

  - [x] Display the list of user's posts
  - [x] A new post form that sends a POST request to `new-post.php`
  
- [x] `new-post.php` PROCESS

  - [x] Different for each project

### [Project instructions](https://mickael-martin-nevot.com/institut-g4/php/?:s11-projet.pdf)

- [ ] `Responsive` mobile, tablet and desktop
- [ ] `SEO` (meta, title, description, etc...)
- [ ] `Cross-browser` compatibility (Chrome, Firefox and Safari)
- [ ] `Accessibility` (aria-label, alt, etc...)
- [ ] `Form` (placeholder, required, pattern...)
- [ ] `Ajax` with JQuery
- [ ] `Arrow to top` for long pages
- [ ] `W3C` validation for `HTML` and `CSS`
- [ ] `PHP docs` for documentation
- [ ] `PHP Unit` for unit tests
- [ ] `Travis CI`, `Gitlab` or `Jenkins` for continuous integration
- [ ] `Official information` like addresses, social medias, etc...

- [ ] `Eco-conception` tests with :

  - [ ] `DevTools`
  - [ ] `Lighthouse`
  - [ ] `WAVE`
  - [ ] `HeadingsMap`
  - [ ] `GreenIT-Analysis`

## Check security

- [ ] Make "TODO" comments
- [ ] Remove every console.log
- [ ] Check database insert validated by `htmlspecialchars`

- [ ] Check feedback for user

  - [ ] Login/Register failed
  - [ ] Send message failed
  - [ ] Send subject failed

- [ ] Check prod error messages

  - [ ] Page not found
  - [ ] Something went wrong