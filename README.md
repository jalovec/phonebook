### 1. To run project you have to install:
- Composer - [download actual version](https://getcomposer.org/download/)
- Docker - [download actual version](https://docs.docker.com/engine/install/)
- Docker Compose ( ussualy with Docker)
- support for **Makefile** in Linux you can use command  `make init`
### 2. How to run project
Project runs in docker containers and is supported by commands in Makefile.
- Choose the name of project and change it in `PROJECT_NAME` parameter in `.env` file
- Run command `sudo nano /etc/hosts` and add inside and save. The `phonebook` is name of project you ad in `.env` file to `PROJECT_NAME` parameter.
   >   127.0.0.1app.phonebook.local<br>
   >   127.0.0.1 adminer.phonebook.local
- In project folder run command `make up`
- You project should be automatically setup after few seconds

