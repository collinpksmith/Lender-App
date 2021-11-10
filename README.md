### Installation

Download code from github
``` sh
    $ git clone https://github.com/SeniorEng/Lender-App.git
```
Install libraries
``` sh
    $ npm install
```
Run script
``` sh
    $ npm run dev
```

Install libraries
``` sh
    $ composer insall
```

Create a database

Config envirenment variables
``` sh
    copy .env.example file and update variables
    rename it .env
```

Create tables and populate basic information
``` sh
    $ php artisan migrate
    $ php artisan db:seed
```

Generate a new key
``` sh
    $ php artisan key:generate
```

Run script
``` sh
    $ php artisan serve
```
