<?php

//Database link
require_once 'PDOHandler.php';

//##### User stuff #####

//### Models ###
require_once 'modules/user/model/User.php';
require_once 'modules/user/model/UserCommandInterface.php';
require_once 'modules/user/model/UserCommand.php';
require_once 'modules/user/model/UserRepositoryInterface.php';
require_once 'modules/user/model/UserRepository.php';

//### Controllers ###
require_once 'modules/user/controller/UserController.php';



//##### Email Stuff #####

//### Models ###
require_once 'modules/email/src/model/Email.php';
require_once 'modules/email/src/model/EmailRepositoryInterface.php';
require_once 'modules/email/src/model/EmailRepository.php';
require_once 'modules/email/src/model/EmailCommandInterface.php';
require_once 'modules/email/src/model/EmailCommand.php';

//### Controllers ###
require_once 'modules/email/src/controller/EmailController.php';