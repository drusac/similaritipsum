## Installation Documentation

Prerequisites:
- Have [Docker Desktop](https://www.docker.com/products/docker-desktop) installed
- Have [Windows Terminal](https://www.microsoft.com/en-us/p/windows-terminal/9n0dx20hk701?rtc=1&activetab=pivot:overviewtab) installed
- Have WSL2 installed and enabled, [Microsoft docs](https://docs.microsoft.com/en-us/windows/wsl/install)
- Have properly configured Docker [Desktop WSL 2 backend](https://docs.docker.com/desktop/windows/wsl/)

The most easiest way to run project would be to contact me and ask for "sail share". Then I would expose my Laravel app and you could test without the need of local installation.
Just switch Insomnia to production environment and you are ready to go.

If you want to install it locally on you machine, please proceed.

Open Windows Terminal and use it with Ubuntu 20.04. Navigate to home folder using:

```bash
cd
```

To avoid performance issues, clone GitHub project to your Ubuntu 20.04 home folder (NOT into your Windows filesystem):

```bash
git clone https://github.com/drusac/similaritipsum.git
```

Go to Git project folder:
```bash
cd similaritipsum
```

Set folder permissions:
```bash
sudo chmod -R 777 .
```

Install Composer dependencies:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

```

Set Laravel Sail alias using following command:
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Create and edit .env file:
```bash
sudo cp .env.example .env
sudo nano .env
```

Enter database credentials to .env file:
```bash
DB_HOST=mysql
DB_DATABASE=similaritipsum
DB_USERNAME=sail
DB_PASSWORD=password
```

Run Sail command, you can use "-d" to run in detached mode, this could take a while:
```bash
sail up
sail up -d
```

When Sail is up, run this command to check PHP version:
```bash
sail php --version
```

At this point you should SSH into MySQL container and create database for development and testing:
```bash
create database similaritipsum;
create database similaritipsum_testing;
```

Run database migrations
```bash
sail artisan migrate
```

Create application key
```bash
sail artisan key:generate
```

Open VS Code using:
```bash
code .
```

You should be able to access Laravel application on [localhost](http://localhost/).

Access Backpack CMS using [http://localhost/admin/login](http://localhost/admin/login), you will have to register before logging in.

Download insomnia-similaritipsum.json from this repository and import it into Insomnia REST for API testing.

## Run unit tests

You can run the tests with:

```bash
sail test
```