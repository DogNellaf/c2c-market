# C2C 3D Models Market Diploma Project 

This repository contains the C2C code of the three-dimensional model exchange service. The service allows users to download, view, sell and buy 3D models.

Stack: PHP (Laravel) + WampServer

## Installation

1. Clone the repository to your computer:


git clone https://github.com/DogNellaf/c2c-3d-market


2. Install Composer:


https://getcomposer.org/


2. Install WampServer:


https://www.wampserver.com/en/download-wampserver-64bits/


3. Copy "[Market](Market)" folder to WampServer project directory


4. Check "Wamp Settings/Caution: Risky! Only for experts/Allow links on projects homepage" settings


5. Migrate to database:


php artisan migrate


6. Open the application in the browser at http://localhost/C2CMarket/public/


## Usage

After launching the application, users can register, log in, create ads for the sale of models, view their models, buy models, view purchased models, download models. An administrator is also created with the username and password admin/admin, who can confirm or reject ads.

## License

This project is licensed under the terms of the GPL-3.0 license. Detailed information can be found in the [LICENSE](LICENSE) file.