### Installing Using NVM

An alternative to installing Node.js through apt is to use a tool called nvm, which stands for “Node Version Manager”. Rather than working at the operating system level, nvm works at the level of an independent directory within your user’s home directory. This means that you can install multiple self-contained versions of Node.js without affecting the entire system.

Controlling your environment with nvm allows you to access the newest versions of Node.js while also retaining and managing previous releases. It is a different utility from apt, however, and the versions of Node.js that you manage with it are distinct from those you manage with apt.

To download the nvm installation script from the project’s GitHub page, you can use curl. Note that the version number may differ from what is highlighted here:

```
$ curl -sL https://raw.githubusercontent.com/nvm-sh/nvm/v0.34.0/install.sh -o install_nvm.sh
$ bash install_nvm.sh
```

We don’t need sudo here because nvm is not installed into any privileged system directories. It will instead install the software into a subdirectory of your home directory at ~/.nvm. It will also add some configuration to your ~/.profile file to enable the new software.

To gain access to the nvm functionality, you’ll need to either log out and log back in again or source the ~/.profile file so that your current session knows about the changes:

```
$ source ~/.profile
```

With nvm installed, you can install isolated Node.js versions. For information about the versions of Node.js that are available, type:

```
$ nvm ls-remote
```

As you can see, the current LTS version at the time of this writing is v10.16.2. You can install that by typing:

```
$ nvm install 10.16.3
```

Usually, nvm will switch to use the most recently installed version. You can tell nvm to use the version you just downloaded by typing:

```
nvm use 10.16.3
```

As always, you can verify the Node.js version currently being used by typing:

```
$ node -v

v10.16.3
```

If you wish to default to one of the versions, type:

```
$ nvm alias default 10.16.3
```

This version will be automatically selected when a new session spawns. You can also reference it by the alias like this:

```
$ nvm use default
```


[How To Install Node.js on Debian 10](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-debian-10)
