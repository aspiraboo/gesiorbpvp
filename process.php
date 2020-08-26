<?php
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);

define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if(!defined('ONLY_PAGE'))
    define('ONLY_PAGE', false);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if(DEBUG_DATABASE)
    Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

// LOGIN
if(!ONLY_PAGE)
    include_once('./system/load.login.php');
// LOGIN END

// COMPAT
// some parts in that file can be blocked because of ONLY_PAGE constant
include_once('./system/load.compat.php');
// COMPAT END

// LOAD PAGE
include_once('./system/load.page.php');

// load vendor
require('vendor/autoload.php');

function generate_emails($number = 1, $username_length = 24)
{
    if (is_numeric($number) && $number != 0) {
        if ($number > 1000) { //put hard limit on generate request
            $number = 1000;
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $tld = ["com"];
        for ($i = 0; $i < $number; $i++) {
            $randomName = '';
            for ($j = 0; $j < $username_length; $j++) {
                $randomName .= $characters[rand(0, strlen($characters) - 1)];
            }
            $k = array_rand($tld);
            $extension = $tld[$k];
            $fullAddress = $randomName . "@" . "hotmail." . $extension;
            $generated_emails[] = $fullAddress;
            return $fullAddress;
        }
    }

}


try {
    // quantidade de contas que deseja fazer.
    $amount = 50;
    $amountChars = 1;


    $sexs = [0,1];
    $vocations = ['2' => '2','3' => '3','4' => '4'];

    $account = 'rodrigo001';
    $password = 'natan123';

    $account_object = new Account($account, 'name');

    $characters = explode(';',file_get_contents('test.txt'));

    $infoChars = '';
    $count = 0;

    foreach ($characters as $character) {
        $name = trim($character);

        if ($name) {
            $sex = array_rand($sexs);
            $vocation = array_rand($vocations);
            $newchar_town = 1;
            $world_id = 0;

            $char_to_copy = new Player();
            $char_to_copy_name = $config['site']['newchar_vocations'][$world_id][$vocation];
            $char_to_copy->find($char_to_copy_name);

            $char_to_copy->setLookType(136);
            $char_to_copy->setID(null); // save as new character
            $char_to_copy->setLastIP(0);
            $char_to_copy->setLastLogin(0);
            $char_to_copy->setLastLogout(0);
            $char_to_copy->setName($name);
            $char_to_copy->setAccount($account_object);
            $char_to_copy->setSex($sex);
            $char_to_copy->setTown($newchar_town);
            $char_to_copy->setPosX(0);
            $char_to_copy->setPosY(0);
            $char_to_copy->setPosZ(0);
            $char_to_copy->setBalance(0);
            $char_to_copy->setWorldID((int) $world_id);
            $char_to_copy->setCreateIP('1270001');
            $char_to_copy->setCreateDate(time());
            $char_to_copy->setSave(); // make character saveable
            $char_to_copy->save(); // now it will load 'id' of new player

            $count++;

            $infoChars .= "{$account} {$password} {$name} \n";
        }
    }

    echo "Foram criados o total de {$count} characters </br>";

    echo '<pre>';var_dump($infoChars);die;



//    for($i = 0; $i <= $amount; $i++) {
//
//        $reg_account = new Account();
//        $reg_account->setName(random_int(999999,9999999));
//        $reg_account->setPassword(random_int(999999,9999999));
//        $reg_account->setEMail(generate_emails());
//        $reg_account->setGroupID(1);
//        $reg_account->setCreateDate(time());
//        $reg_account->setCreateIP('127001');
//        $reg_account->setFlag('127001');
//        $reg_account->setVipTime(0);
//        $reg_account->setGuildPoints(0);
//        $reg_account->setBackupPoints(0);
//        $reg_account->setPremDays(0);
//        $reg_account->setLastDay(0);
//        $reg_account->setPremiumPoints(0);
//        $reg_account->setPageAccess(0);
//
//        $reg_account->save();
//
//        for ($c = 0; $c <= $amountChars; $c++) {
//            $generator = new \Nubs\RandomNameGenerator\Vgng();
//
//            $newchar_name = ucwords(strtolower(trim($generator->getName())));
//            $newchar_sex = 0;
//            $newchar_vocation = 1;
//            $newchar_town = 1;
//            $world_id = 0;
//
//            $char_to_copy = new Player();
//            $char_to_copy_name = $config['site']['newchar_vocations'][$world_id][$newchar_vocation];
//            $char_to_copy->find($char_to_copy_name);
//
//            $char_to_copy->setLookType(136);
//            $char_to_copy->setID(null); // save as new character
//            $char_to_copy->setLastIP(0);
//            $char_to_copy->setLastLogin(0);
//            $char_to_copy->setLastLogout(0);
//            $char_to_copy->setName($newchar_name);
//            $char_to_copy->setAccount($reg_account);
//            $char_to_copy->setSex($newchar_sex);
//            $char_to_copy->setTown($newchar_town);
//            $char_to_copy->setPosX(0);
//            $char_to_copy->setPosY(0);
//            $char_to_copy->setPosZ(0);
//            $char_to_copy->setBalance(0);
//            $char_to_copy->setWorldID((int) $world_id);
//            $char_to_copy->setCreateIP('1270001');
//            $char_to_copy->setCreateDate(time());
//            $char_to_copy->setSave(); // make character saveable
//            $char_to_copy->save(); // now it will load 'id' of new player
//
//            if($char_to_copy->isLoaded()){
//                $char_to_copy->saveItems();
//                $char_to_copy->saveSkills();
//            }
//
//
//        }
//    }


} catch(Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    die;
}

