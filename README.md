# User login using Symfony goodies

This is a project that demonstrate how to use Symfony to create a user login system

## Highlights of this project

* Everything have been dockerized, no additional environment setting required
* Demonstrate how reverse proxy work using __traefik__
* Demonstrate how to use web interface to manage docker container using __portainer__
* Demonstrate how to use web interface to manage database using __adminer__
* Demonstrate how __Symfony Guard component__ works
* Demonstrate how __Doctrine custom annotation__ works
* Demonstrate how to use __Redis__ to store session data
* Demonstrate how __event listener__ handle the login event and redirect to correct landing page

### Bring up the project

1. git clone to your local
2. Make sure you have docker instead in your local machine
3. I have `.env` provided in the repo - It's a bad practice but I guess it'll be alright for demo app.  
4. Run the command to bring up docker containers using `docker-compose up`, please keep this process running, or you can use `docker-compose up -d` to run all the docker containers in detached mode
    1. This will bring up several docker containers
        1. __Reverse proxy container__
            * This container is using traefik as the reverse proxy to redirect traffic to correct docker container
        2. __Web server container__
            * This container is using nginx as web server which could handle traffic to php-fpm
        3. __PHP container__
            * This container is using php-fpm to execute the php code and give response to web server container
        4. __Redis contrainer__
            * This container running redis service with alpine. you might want to use ElasticCache in production.
        5. __Database container__
            * This is a container that runs MySQL database so Symfony can use it
        6. __Database Management container__
            * This container is just simply an adminer that allow user to manage MySQL DB in web interface. Or you can choose your flavour of app to do it, usually I use DataGrip and Sequel Pro.
            * For testing this project, you can use `db.mysql` as host and `root/root` as credentials.
        7. __Docker Management container__
            * This container uses __portainer__ as the docker management web interface, you can use this web interface to see all the docker clusters/images/containers, and also see system resource usage, logs, etc.
    2. There is some handy urls that you can use
        1. Symfony App - `user-login.docker.localhost`
        2. Docker Management App - `portainer.docker.localhost`
        3. Database Management App - `adminer.docker.localhost`
5. To run the database migration and apply user fixtures:
    1. make sure you are in the project root directory and have all the docker service running.
    2. run command `docker-compose exec php bin/console doctrine:migrations:migrate` to apply the database migrations
    3. run command `docker-compose exec php bin/console doctrine:fixture:load` to apply the user fixtures.
6. To check the redis you can run the command `docker-compose exec cache.redis redis-cli` or `redis-commander` if you prefer web gui. You can use `cache.redis` as host.

### Credentials for testing

Username | Password | User type
--- | --- |---
`iamemployee` | `superSecurePassword` | `employee`
`iamcontractor` | `yetAnotherSecurePassword` | `contractor`

### Things need to do if it's production application

1. tests, a lot more tests needed to get decent tests coverage.
2. firewall, currently employee will be redirect to `/employee` page, however they can still manually go to `/contract` page by manually type url. This bit can be restricted given proper role and modify `seciruty.yml`

### Disclaimer

1. I'm using the `GuardAuthenticationListener` provided by __Symfony Guard__ component.
2. Annotation check is in the `UserService` class.
3. `.env` file includes credentials, i know it's bad practice but this project is purely for demo purpose so I just leave it there :)
4. I would use a lot more design patterns if it invloves complex business logic.
5. I didn't demonstrate `git` by creating new branch/merge, etc. However I am confident for using `git`.