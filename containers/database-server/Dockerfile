FROM mariadb:10.3.0

# nano for editing
RUN apt-get update && apt-get -y --force-yes install nano
RUN echo 'export TERM=xterm' >> $HOME/.bashrc

# htop for monitoring
RUN apt-get update && apt-get -y --force-yes install htop

# copy custom mysql configuration file
COPY custom.cnf /etc/mysql/conf.d/custom.cnf
