### Pre requirements:
- docker
- docker-compose

### Run the project:
1. run command "docker-compose up -d"
2. run "docker ps" and find php container id
3. run "docker exec -it {php_container_id} sh"
4. run "php bin/console doctrine:migrations:migrate" and accept changes
5. add classroom-api.loc to hosts

#### Create
To create new classroom use `POST: http://classroom-api.loc/classrooms` with body:
```
{
    "name": "testName"
}
```

#### Get
To get classroom by id use `GET: http://classroom-api.loc/classrooms/{id}`

#### Update
To update classroom use `PATCH: http://classroom-api.loc/classrooms/{id}` with body:
```
{
    "name": "newTestName"
}
```

#### Get list
To get all classrooms use `GET: http://classroom-api.loc/classrooms`

#### Delete (deactivate)
To delete (deactivate) classroom by id use `DELETE: http://classroom-api.loc/classrooms/{id}`
