phar: make-phar.php
	rm -rf make.phar 
	php make-phar.php --entry _make-phar.php --shebang . make.phar
	chmod +x make.phar

install: phar
	install -d /usr/local/bin
	install -m 0755 make.phar /usr/local/bin/make.phar

uninstall:
	rm -rf /usr/local/bin/make.phar

# vim: noet
