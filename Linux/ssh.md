### Creates a new ssh key, using the provided email as a label
`ssh-keygen -t rsa -b 4096 -C "your_email@example.com"`

## Copy the public key into the new machine's authorized_keys file with the ssh-copy-id command.
ssh-copy-id user@123.45.56.78

### Copy the public key file manually
cat ~/.ssh/id_rsa.pub | ssh user@machine "mkdir -p ~/.ssh; cat >> ~/.ssh/authorized_keys"

## Delete lines from `known_hosts`

### Delete a host
`ssh-keygen -R hostname`

### Delete a line
`sed -i 'Xd' ~/.ssh/known_hosts` where `X` is a line number

## SSH Copy

### SCP

Syntax:
scp <source> <destination>
-r recursive, can be used for directories

To copy a file from B to A while logged into B:
`scp /path/to/file username@a:/path/to/destination`

To copy a file from B to A while logged into A:
`scp username@b:/path/to/file /path/to/destination`

### rsync Alternative
You can also use the rsync command to copy files in a similar manner. rsync has a few more options and the advantage that it only copies changed files.

rsync -a [/local/path/] [user@host]:[remote/path/]
