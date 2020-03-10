# Laravel-Merged

# Pre-requisites
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) ^2.21.0
- [Hub](https://hub.github.com/) ^2.14.1

And make sure  your hub command is in `/usr/local/bin/hub` path. also make sure you can clone repositories by hub try below as example.
```
hub clone laravel/framework
```

# Installation
Clone the repo
```
git clone git@github.com:ahmedash95/laravel-merge.git
```
Move to the directory and copy .env.example to .env and setup your database, queues and cache

Run composer
```
composer install
```

Migrate database
```
php artisan migrate
```

Choose a directory to store the repositories you want to follow it's merged prs
```
mkdir $projectRoot/storage/cloned_repos
```
Update CLONE_PATH in your .env file to the new path
```
CLONE_PATH=storage/cloned_repos
```
Now make sure to create github [Personal Access Token](https://github.com/settings/tokens) with READ-ONLY permissions then update .env
```
GITHUB_TOKEN="YOUR_GITHUB_TOKEN"
```
Now We need to create an github oauth app to allow users login via their github account. open [OAuth Apps](https://github.com/settings/developers) and create a new app then update .env
```
GITHUB_CLIENT_ID="CLIENT_ID_TOKEN"
GITHUB_CLIENT_SECRET="SECRET_TOKEN"
```

Then use your twitter account to create a twitter app and update the tokens in .env
```
TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_SECRET=
```
Or update .env file to disable twitter notifications
```
TWEET_MERGED_PRS=false
```

Now all is good. let's clone the repo and run our first pr:fetch
```
php artisan laravel:update
```
Then
```
php artisan pr:fetch
```
Now run
```
php artisan serve
```
and visit [http://localhost:8000](http://localhost:8000)