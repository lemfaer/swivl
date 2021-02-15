### Installation
```shell
```

### Get multiple classrooms
```shell
curl -X GET "http://localhost:8000/api/classrooms?limit=10&offset=0"
```

### Get one classroom
```shell
curl -X GET "http://localhost:8000/api/classroom/1"
```

### Create new or replace a classroom
```shell
curl -X POST "http://localhost:8000/api/classroom" -d '{}'
```
```shell
curl -X POST "http://localhost:8000/api/classroom/1" -H 'content-type: application/json' -d '{"name": "test2"}'
```
