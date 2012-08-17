make.phar
=========

A simple utility that helps to make self-extracting Phar archives for deploy.

There are times when the only option to deploy your application to a
client's site is by using FTP. FTP is not designed to transfer a
multitude of small files, so in order to speed up the process, you need
to pack your files into some kind of archive. And make.phar will gladly
help you to do this in a simple manner.

Issue this command:

    $ php make-phar.php path/to/directory output.phar

Then upload output.phar to a server, and access it via web browser. If
you see the OK message, phar has been extracted and you are ready to go.

## Installation

Keeping a repository with make-phar.php is a good idea to test how the
application does work. But it's more convenient to install the script
and use it as an program. For Mac, Linux and other Unix users, there is
a Makefile provided which automates installation process.

    # make install

Will create a make.phar executable and put it into your /usr/local/bin
directory.

    # make uninstall

Will delete the make.phar executable from /usr/local/bin.


vim: set tw=72:
