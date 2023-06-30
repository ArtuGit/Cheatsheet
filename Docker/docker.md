### Images

List all images
`docker images --all`

Remove a image
`docker rmi IMAGE_ID`

Build an image (in a current directory)
`docker build -t IMAGE_NAME .`
prepare to publish with a tag
`docker build -t <your-dockerhub-username>/<image-name>:<tag> .`

### Containers

Run a container by an image (with ports mapping)
`docker run -it -p 5000:5000 IMAGE_NAME`

 List running containers:
 `docker ps`
 or
 `docker container ls`

List all containers:
`docker ps -a`

Stop all containers:
`docker stop $(docker ps -a -q)`

Stop a container
`docker stop CONTAINER_ID`

Stop and delete a container
`docker rm -f CONTAINER_ID`

Remove all Stopped Containers
`docker container prune`
or
`remove all stopped containers`
or
`docker rm $(docker ps -aq)`

### Volumes

List all volumes
`docker volume l`

Show volumes by containers
```
for v in $(docker volume ls --format "{{.Name}}")
do
  containers="$(docker ps -a --filter volume=$v --format '{{.Names}}' | tr '\n' ',')"
  echo "volume $v is used by $containers"
done
```

List all volumes
`docker volume ls`


List dandling volumes
`docker volume ls -qf dangling=true`


Remove a volume
`docker volume rm VOLUME_ID`

Remove dandling volumes
`docker volume prune`
or
`docker volume rm $(docker volume ls -qf dangling=true)`

### Networks

List all networks
`docker network ls`

Remove a network
 `docker network rm NEWWORK_ID`

Remove all unused network
`docker network prune`

### Logs
Fetch the logs of a container
`docker logs CONTAINER_ID`


### Tags
Set a tag
`docker tag SOURCE_IMAGE[:TAG] TARGET_IMAGE[:TAG]`

### Docker Hub
docker push <your-dockerhub-username>/<image-name>:<tag>