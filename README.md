# Work in progress - not suitable for deployment!

![MJP Media Manager-logos](https://github.com/MatthewPageUK/mjp-media/assets/46349796/1ac2df0e-29fe-4766-9bed-3b60a3779a98)


# MJP Media Manager

A simple multi-user web based media manager for uploading and storing images. Built with Laravel, Livewire and Tailwind CSS.

- [Features](#features)
- [Installation](#installation)
- [Colours](#colours)
- [License](#license)

## Features

- Web based media manager
- Create users and assign storage capacity
- Upload images and other files
- Create folders and sub-folders
- File explorer
- Embedded explorer to integrate with other applications

## Installation

Clone the repo

```bash
git clone
```

Launch the docker containers

```bash
sail up -d
```

Install composer dependencies

```bash
sail composer install
```

Install npm dependencies

```bash
sail npm install
```

Create a .env file and edit as necessary

```bash
cp .env.example .env
```

Generate an app key

```bash
sail artisan key:generate
```

Setup the application

```bash
sail artisan mmm:setup
```

Or setup with demo data and users

```bash
sail artisan mmm:setup-demo
```

You can now login with the default user:

```bash
email: demo@example.com
password: password
```

> Remember to change the default user password!

You can reset the application, delete all users and files:

```bash
sail artisan mmm:reset
```

## Colours

You can easily change the colour theme in the ```tailwind.config.js``` file by changing the settings to any of the standard Tailwind colours.

```javascript
colors: {
    primary: colors.blue,
    secondary: colors.amber,
    highlight: colors.purple,
    button: colors.sky,
},
```

## Screen shots

File explorer

![image](https://github.com/MatthewPageUK/mjp-media/assets/46349796/a7c81e07-f3de-4fc6-8db8-73e5d62b1a8f)

Admin dashboard

![image](https://github.com/MatthewPageUK/mjp-media/assets/46349796/6953c135-0c4f-422f-8c49-b4927977b4db)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
