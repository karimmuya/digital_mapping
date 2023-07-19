# Digital Mapping

## Main app

### How to run

#### 1. Go to the application folder  using cd command on your cmd or terminal.

```
cd main_app
```

#### 2. Install dependencies.

```
composer install
```
If it brings errors run `composer update` first then run `composer install`

#### 3. Rename env.example file to .env on the root folder.

```
cp env.example .env
```

#### 4. Add your database credential in .env file the run then following command to  generate app keys.

```
php artisan key:generate
```
#### 5. Create database then run migration

```
 php artisan migrate
```

#### 6. Link Storage

```
php artisan storage:link
```

#### 7. Run the app

```
php artisan serve
```



## Admin app

### How to run


#### 1. Install Virtual environment

```
pip3 install virtualenv
```

#### 2. Create Virtual environment  

```
virtualenv venv
```

#### 3. Activate Virtual environment (Linux / MacOS) 

```
. .venv/bin/activate
```

#### 4. Install Dependencies 

```
pip3 install -r requirements.txt
```

#### 4. Run the project 

```
python3 -m flask --app application run --debug 
```



### Enjoy!!.. 😁