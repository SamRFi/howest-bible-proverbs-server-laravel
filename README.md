# ./vendor/bin/sail artisan db:seed


# Proverbs API Server - Laravel

## Description

This project is an API server for the Proverbs application. It handles user authentication, user posting and serves proverb chapters based on the provided language and chapter number. 


## Installation & Setup with Laravel Sail (Linux or WSL on Windows)

**Note:** These instructions are intended for Linux systems or Windows systems using WSL (Windows Subsystem for Linux). If you are using Windows, make sure to ~[install WSL](https://docs.microsoft.com/en-us/windows/wsl/install)~ before proceeding.

1. Install Docker and Docker Compose on your local machine. Docker can be downloaded from ~[here](https://www.docker.com/products/docker-desktop)~. Make sure you also have Git installed on your machine.

2. Clone this repository by running `git clone git@git.ti.howest.be:TI/2022-2023/s4/web-frameworks/projects/_groups/group-38/server.git`.

3. Navigate to the project directory and copy the `.env.example` file to `.env` using `cp .env.example .env`. Adjust the database confgit@git.ti.howest.be:TI/2022-2023/s4/web-frameworks/projects/_groups/group-38/server.gitiguration to your own database.
   
4. From the repo, run the following command: `docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs`

5. Install Laravel Sail dependencies using the command `./vendor/bin/sail up -d` to build the Docker containers and start the application in detached mode.

6. Run `./vendor/bin/sail composer install` to install the project dependencies.

7. Generate an app key by running `./vendor/bin/sail artisan key:generate`.

8. Run the database migrations and seed the database using `./vendor/bin/sail artisan migrate --seed`.

9.  The application should now be running and accessible at `localhost:80` (or whatever port you've configured).

10. Run `./vendor/bin/sail down` to stop the Docker containers when you're done.

## Running the Server

If you stopped the docker container after installation, you can likewise start it again by using the command `./vendor/bin/sail up -d`. To stop it, you can use `./vendor/bin/sail down`.


## API Endpoints

You can see the swagger.json file for a more detailed description of the api endpoints, althought they are also described in the routes/api.php file itself.

Briefly, the project includes the following API endpoints:

- **Login**: `POST /api/login`
  
  This endpoint is used to log a user into the application. It requires a JSON body with `email` and `password` fields.

- **Logout**: `POST /api/logout`

  This endpoint is used to log out the authenticated user and invalidate their token.

- **Register**: `POST /api/register`
  
  This endpoint is used to register a new user. It requires a JSON body with `name`, `email`, and `password` fields.

- **Get Proverbs Chapter**: `GET /api/proverbs/{chapter_number}`
  
  This endpoint is used to fetch a chapter from the Book of Proverbs by its chapter number. It accepts a `language` query parameter for language specification. The chapter number should be replaced with the desired chapter number in the URL.

- **Add Insight**: `POST /api/insights`

  This endpoint is used to add a new insight. It requires user authentication and a JSON body with `chapter_id`, `verse_number` and `content` fields.

- **Get Insights**: `GET /api/insights`
  
  This endpoint is used to fetch all insights for the authenticated user. It requires user authentication.

- **Update Insight**: `PUT /api/insights/{id}`

  This endpoint is used to update an existing insight by its ID. It requires user authentication and a JSON body with `chapter_id`, `verse_number` and `content` fields. The ID should be replaced with the desired insight ID in the URL.

- **Delete Insight**: `DELETE /api/insights/{id}`

  This endpoint is used to delete an insight by its ID. It requires user authentication. The ID should be replaced with the desired insight ID in the URL.

### Authentication
As described above, some endpoints require authentication. When you log in, a set-cookie header is passed along the response. Afterwards, the endpoints requiring authentication will automatically be authenticated by the stored cookie from the browser of the client.

## Known bugs
Currently, the `GET /api/proverbs/{chapter_number}` endpoints won't return anything unless you give a query specifying the language. Normally it should default to English but that is not the case, meaning that the query is unfortunately no longer optional, but mandatory, for using the endpoint.

# below is the default Laravel documentation




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
