### Disks Info
`df -h`

### Most big directories
`du -Sh | sort -rh | head -5`

### NCDU 
`sudo apt install ncdu`
`ncdu`
`ssh -C user@system ncdu -o- / | ./ncdu -f-`


### GUI
Disk Usage Analyzer (aka Baobab)