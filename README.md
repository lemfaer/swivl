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
curl -X POST "http://localhost:8000/api/classroom" -H 'content-type: application/json' -d '{"name":"Chemistry Classroom", "active":true, "formed_at":"2008-01-20"}'
```
```shell
curl -X POST "http://localhost:8000/api/classroom/1" -H 'content-type: application/json' -d '{"name": "Math Classroom"}'
```

### Patch classroom (update status)
```shell
curl -X PATCH "http://localhost:8000/api/classroom/1" -H 'content-type: application/json' -d '{"active": true}'
```

### Delete classroom
```shell
curl -X DELETE "http://localhost:8000/api/classroom/1"
```
