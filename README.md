<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Sistem Penjadwalan Tugas Pelayanan Listrik (Yantek) PLN

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.


## Project Description

This project is a web-based platform developed to assist PLN administrators in managing and monitoring the assignment of technical staff (Yantek) for handling various electrical services to customers in an organized and efficient manner. The system aims to optimize resource allocation and improve service quality by providing features such as:

* **Comprehensive Dashboard**: Displays key data such as active employees and scheduled tasks.
* **Integrated Employee Management**: Enables registration and management of technical staff details, including profiles, positions, assignment areas, and availability status.
* **Dynamic Task Scheduling**: Structured task assignments with location, time, and task type details, including the work status (New, In Progress, Completed).
* **Task Status Monitoring**: Displays the current status of tasks, allowing administrators to easily track job progress.
* **Admin Profile Information**: Shows the details of the logged-in admin, such as full name, email, position, and account information.

The primary goal of this system is to enhance operational efficiency in PLN’s technical services, ensuring quick response times to power disruptions, optimizing technician visit routes, reducing customer wait times, and facilitating overall service quality monitoring.

## Framework & Tools Used

* **Laravel 12**: A modern PHP framework with a structured MVC architecture and robust features for application security and development speed.
* **Bootstrap**: A CSS framework for creating responsive and attractive web layouts with ready-to-use UI components and a flexible grid system.

### Tools:

* **MySQL**: Relational database management system used to store and manage application data.
* **Visual Studio Code (VSCode)**: Lightweight yet powerful source code editor for writing and managing program code.
* **Laragon**: Local development environment for fast and efficient server and database setup.
* **Composer**: PHP dependency manager for handling project libraries and packages.

## Features Implemented

* **Dashboard**: Displays total employees and tasks.
* **Employee Management**: Shows a table of registered employees with their details like position, assigned tasks, and task status.
* **Add Employee**: Allows adding new technical staff with full name, username, email, password, assignment details, and initial task status.
* **Edit Employee**: Enables updating employee data.
* **Task Management**: Displays created task schedules and their statuses.
* **Create Task**: Used to add new tasks, including employee assignments, contacts, task details, location, start and end dates, and initial task status.
* **Profile**: Displays account information like full name, email, position, assignment area, registration date, and profile picture.

## Challenges Faced & Solutions

### 1. Database Migration Issues

* **Problem**: Encountered errors during database migration due to incorrect database connection configurations.
* **Solution**: Fixed the database settings in the `.env` file and re-ran the migration commands.

### 2. Hosting Issues (Page Isn’t Working)

* **Problem**: After deploying to hosting, the web page was inaccessible.
* **Solution**: Despite checking the uploaded files for errors, the issue remains unresolved.

## GitHub & Hosted Website Links

* **GitHub Link**: [GitHub Repository](https://github.com/RenataYasmineSelomita/202231059_PWL_PLN-ENERGY)
* **Deploy Link**: [Deployed Website](http://sistem-penjadwalan-pelayanan-teknik-pln.infy.uk/)
* **Demo YouTube Link**: [Demo Video](https://youtu.be/T64NWNModkE)

Feel free to explore the code, contribute, and provide feedback!


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
