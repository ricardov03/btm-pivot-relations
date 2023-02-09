<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Explaining Belongs To Many Relationship loading Pivot data.

This repository has the main purpose to respond to the following asked question from Stack Overflow:
https://stackoverflow.com/questions/75340790/how-to-access-a-pivot-table-from-a-resource-in-laravel-9

## The Problem
- The user needs to load information from a Belongs To Many relation table in the `Laravel way 🙂`.

## The Answer
- Check the [README.md](#) file on the `Models` folder.

### How to use this Repository
- [ ] Clone the project.
- [ ] Configure a Database. I already included a Sqlite3 DB on the project. Just update the drive to `sqlite` and set the **DB_DATABASE** variable to your `/project/route/path/./database/relations.db`.
- [ ] Migrate the Database.
  ```bash
  php artisan migrate:fresh --seed
  # I use the seed flag to include some samples in the database.
  ```
- [ ] Review the Migrations
- [ ] Review the Models
- [ ] Check the Product Controller to understand how to retrieve information using Eloquent.
 
After publish the project in your local environment, you can review the api response by visiting the following endpoint:
```
http://[your-local-env-domain]/api/product
```
