## JsonTransformer
JsonTransformer is developed as a case study.
Project is developed on Ubuntu using Docker 27.4.1, Laravel 11.37.0 and PostgreSQL 17.2

## Installation
1) Pull project using GitHub's Http command.
2) After pulling project go to ""/JsonTransformer/docker
3) Run command 'chmod +x ./up.sh'
4) Run command './up.sh'
5) After dockers are downloaded and set, run command 'docker exec -it jsontransformer_app bash -c "php artisan migrate"'
6) Project should be ready at 'http://localhost:8060/'