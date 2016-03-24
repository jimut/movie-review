# Movie Review

I built this movie review app built with [Laravel](https://laravel.com/) PHP Framework.

In this app admin can login, add a movie and also edit or delete a movie, also add comments, rating. There is also a search functionality made with elasticsearch.

This app is inspired by [Mackenzie Child](https://github.com/mackenziechild). Here is a [tutorial](https://www.youtube.com/watch?v=0DR5JLZ2Qgg) where he built this app in Rails 4.

# Instructions

To run this on your local server.
- You need to install PHP. Easiest way to do this is to use [XAMPP](https://www.apachefriends.org/index.html)
- Clone this repo to your xampp/htdocs dir
- Create a database named movie_review from localhost/phpmyadmin
- Rename the .env.example file to .env and configure it
- Run the following command in that dir

    php artisan migrate
