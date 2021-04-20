# How to see all node process
ps aux | grep node

# Process on a specific port
lsof -i tcp:3000

# Kill ths specific node process
kill -9 PROCESS_ID

# Kill all node process. Be sure!
killall node

