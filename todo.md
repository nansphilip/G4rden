# Todo

## Auth

- [ ] Add a feedback for users if register ou login fails
- [ ] Fix session issue when registering

- [ ] Add feedback for user
  - [ ] Login/Register failed
  - [ ] Send message failed
  - [ ] Send subject failed

## Add message

- [ ] Charge 10 more messages when reaching the top of the chat
- [x] Display date and time in French

## Modele

- [ ] Instanciate a class with `$myModel = new Model();` and fill it with `myModel->myMethodById($id);`
- [ ] Update model subject

## Database

- [ ] Rename `id` to `userId` in `User` table
- [ ] Rename `id` to `messageId` in `Message` table
- [ ] Add `email` column to `User` table
- [ ] Make `email` and `username` constraints unique
- [ ] Create table `Subject` and its `model`
- [ ] Check database insert validated by `htmlspecialchars`

## Errors

- [ ] DEV environment

  - [ ] Check models errors works
  - [ ] Check controllers errors works
  - [ ] Check async errors works
  - [ ] Ckeck login/register

- [ ] PROD environment

  - [ ] Check "Something went wrong" page works
  - [ ] Check "Page not found" page works
  
- [ ] FEEDBACKS for user
  
  - [ ] Login/Register failed
  - [ ] Send message failed
  - [ ] Send subject failed

## Projets

My ideas for the project (Nans):

- [ ] Dark mode
- [ ] `Home page` with links to each pages (Subjects, Messages, Login...)
- [x] General chat in `Message page`
- [ ] Create one page for each `subject` with based on `messages`
- [ ] Display subjects in a `Subjet page` with filters, search bar...
- [ ] `REGEX` validation for inputs

### [Minimalist forum](https://mickael-martin-nevot.com/institut-g4/php/?:s11-projet.pdf)

- [ ] Add `email` field to register and login

- [ ] `forum.php` CONTAINS

  - [ ] A login form that sends a POST request to `login.php`
  - [ ] A register form that sends a POST request to `register.php`

- [ ] `register.php` PROCESS

  - [ ] Check if $_POST contains every required fields, else send a `feedback to the client`
  - [ ] Check if password hardness with `regex`, else send a `feedback to the client`
  - [ ] Check if password and confirm password are the same, else send a `feedback to the client`
  - [ ] Check if `email` is not already used, else send a `feedback to the client`
  - [ ] Insert the new user in the database
  - [ ] Send an email to the user to send to advertise him/her (Nans : "Maybe not profitable enough for us to do it, but very interesting for security if we add an email verification link")
  - [ ] Start session (or set an `active` session variable)
  - [ ] Add user data to session (`id`, `email`, `username`, `fisrtname`, `lastname`, `userType`...)
  - [ ] Redirection to a login protected page

- [ ] `login.php` PROCESS

  - [ ] Check if $_POST contains `email` and `password`, else send a `feedback to the client`
  - [ ] Check if user exists in database, else send a `feedback to the client`
  - [ ] Check if credentials are correct, else send a `feedback to the client`
  - [ ] Start session (or set an `active` session variable)
  - [ ] Add user data to session (`id`, `email`, `username`, `fisrtname`, `lastname`, `userType`...)
  - [ ] Redirection to a login protected page

- [ ] `listpost.php` CONTAINS

  - [ ] Display the list of user's posts
  - [ ] A new post form that sends a POST request to `newpost.php`
  
- [ ] `newpost.php` PROCESS

  - [ ] Differrent for each project

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

- [ ] `Ecoconception` tests with :

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