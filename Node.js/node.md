
### To many open files (nodemon)
Set limits in /etc/sysctl.conf by adding:
```
fs.inotify.max_user_watches=524288
fs.inotify.max_user_instances=512
```
Open a new terminal or reload sysctl.conf variables with

`sudo sysctl --system`