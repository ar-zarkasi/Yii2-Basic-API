<?php
namespace app\config;

class Initiator {

    public static function init()
    {
        require(__DIR__ . '/../vendor/autoload.php');
		self::setEnvironment();
		require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

    }

    protected static function setEnvironment()
    {
        $file_env = __DIR__ . '/../../.env';
        // check for dot env file
		if(is_file($file_env)){
			$conf = parse_ini_file($file_env, true);
			if(false === $conf){
				throw new \Exception("Failed parsing [.env] file.");
			}

			if(!empty($conf['MODE'])){
				switch(strtolower($conf['MODE'])){
					case 'prod':
					case 'production':
						defined('YII_ENV') || define('YII_ENV', 'prod');
						defined('YII_DEBUG') || define('YII_DEBUG', false);
						break;
					case 'test':
					case 'testing':
					case 'staging':
						defined('YII_ENV') || define('YII_ENV', 'test');
						break;
					case 'dev':
					case 'devel':
					case 'development':
						defined('YII_ENV') || define('YII_ENV', 'dev');
						break;
				}
                unset($conf['MODE']);
			} else defined('YII_ENV') || define('YII_ENV', 'dev');

			if(isset($conf['APP_DEBUG'])){
				defined('YII_DEBUG') || define('YII_DEBUG', !!$conf['APP_DEBUG']);
                unset($conf['APP_DEBUG']);
			} else defined('YII_DEBUG') || define('YII_DEBUG', true);
            
            foreach($conf as $key => $value){
                $_ENV[$key] = $value;
            }
            return true;
		}

        throw new \Exception("Failed To Configure An Application");
    }
}
