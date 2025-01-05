## JsonTransformer
JsonTransformer is developed as a case study.
Project is developed on Ubuntu using Docker 27.4.1, Laravel 11.37.0 and PostgreSQL 17.2

## Installation
1) Pull project using GitHub's Http command.
2) After pulling project go to ""/JsonTransformer/docker.
3) Run command 'chmod +x ./up.sh'.
4) Run command './up.sh'.
5) After dockers are downloaded and set, run command 'docker exec -it jsontransformer_app bash -c "php artisan migrate"'.
6) Project should be ready at 'http://localhost:8060/'.

## Usage
JsonTransformer has 2 main pages. 'List Element Mappings' and 'List Transformed Elements'. They both can be reached from navbar.

- 'List Element Mappings' shows a table of added element mappings. Elemental mappings can be seen and edited from this page.
- You can add new elemental mappings using 'Add Elemental Mapping' button. on top right.

- 'List Transformed Elements' page shows elements that are transformed. Including transformed content. 
- Transformed contents cannot be edited.
- New elements can be transformed through 'Transform Content' button.