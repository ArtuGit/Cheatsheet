 List running containers:
 `docker ps`
 or
 `docker container ls`
 
Stop all containers:
`docker stop $(docker ps -a -q)`

Stop a container
`docker stop CONTAINER_ID`

Stop and delete a container
`docker rm -f CONTAINER_ID`


Show volumes by containers
```
for v in $(docker volume ls --format "{{.Name}}")
do
  containers="$(docker ps -a --filter volume=$v --format '{{.Names}}' | tr '\n' ',')"
  echo "volume $v is used by $containers"
done
```

Remove a volume
`docker volume rm VOLUME_ID`