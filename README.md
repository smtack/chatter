# Chatter

<p align="center">
    <img src="public/images/screenshot.png" alt="Chatter Screenshot" width="800">
</p>

## About

Chatter is a social networking application originally based on Laravel Bootcamp's Chirper demo application. The application showcases modern Laravel development techniques including:

- Authentication and authorization
- Database migrations and Eloquent ORM
- Form validation and request handling
- Blade templating engine
- Tailwind CSS for styling
- Likes
- Friendship system

## Installation

1. Run `git clone https://github.com/smtack/chatter.git` and `cd chatter`
2. Run `composer run setup`
3. Run `composer run dev` to start the development server

To enable avatars, copy `default.png` from `public/images/` to `storage/app/public/avatars`, then run `php artisan storage:link`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
