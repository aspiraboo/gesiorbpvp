<?PHP
# Account Maker Config
$config['site']['serverPath'] = "/usr/share/servers/baiakpvp/";
$config['site']['useServerConfigCache'] = false;
$config['site']['worlds'] = array(0 => 'NameOfYourServer');
$config['payment']['site_name'] = "http://localhost";

$towns_list[0] = array(1 => 'Principal');
$config['site']['newchar_towns2'] = 1; // -- AQUI COLOQUE A CITY EM QUE O PERSONAGEM IRÁ NASCER
$config['site']['google_captcha_key'] = "6LckKXgUAAAAAIhrfSDpAFRNmR-ZWmcyvF_f068h";
$config['site']['google_captcha_secret'] = "6LckKXgUAAAAADmOjYtw1lQ-XWGPhJgMfeWtxaq1";
$config['site']['google_captcha_enabled'] = false;
$config['site']['google_captcha_host'] =  'NameOfYourServer';

#Clock
$config['site']['clockactive'] = true;

$config['site']['outfit_images_url'] = '/outfit.php';
$config['site']['item_images_url'] = '/images/items/';
$config['site']['item_images_extension'] = '.gif';
$config['site']['flag_images_url'] = '/images/flags/';
$config['site']['flag_images_extension'] = '.png';
$config['site']['players_group_id_block'] = 3;
$config['site']['limitDeath'] = 8;
$config['site']['levelVideo'] = 100;

# PAGE: donate.php
$config['site']['usePagseguro'] = true; //true show / false hide
$config['site']['usePaypal'] = false;	//true show / false hide
$config['site']['useDeposit'] = true;	//true show / false hide
$config['site']['useZaypay'] = false;	//true show / false hide
$config['site']['useContenidopago'] = false;	//true show / false hide
$config['site']['useOnebip'] = false;	//true show / false hide

# Pagseguro config By IVENSPONTES
$config['pagSeguro']['email'] = ""; //Email Pagseguro
$config['pagSeguro']['token'] = ""; // TOKEN
$config['pagSeguro']['urlRedirect'] = $config['payment']['site_name'] .'/index.php?subtopic=pagconcluido'; //turn off redirect and notifications in pagseguro.com.br
$config['pagSeguro']['urlNotification'] = $config['payment']['site_name'] .'/retpagseguro.php'; //your return location

$config['pagSeguro']['productName'] = 'Premium Points';
$config['pagSeguro']['productValue'] = 1.00; 	// 1.50 = R$ 1,50 etc...
$config['pagSeguro']['doublePoints'] = true; 	## Double points - true is on / false is off

$config['pagSeguro']['host'] = 'localhost';		## YOUR HOST
$config['pagSeguro']['database'] = 'baiak';	## DATABASE
$config['pagSeguro']['databaseUser'] = 'root';	## USER
$config['pagSeguro']['databasePass'] = '';		## PASSWORD


$config['paymentConnection']['BD_HOST'] = "127.0.0.1";
$config['paymentConnection']['BD_USER'] = "root";
$config['paymentConnection']['BD_SENHA'] = "root";
$config['paymentConnection']['BD_BANCO'] = "baiakpvp";
$config['paymentConnection']['BD_PREFIX'] = '';

##Sell Character	  
$config['sellcharlevel'] = 150; // Aqui coloque o level minimo para comércio de char


$config['payment']['paypal']['return_url_paypal'] = $config['payment']['site_name'] . "/?subtopic=ret";
$config['payment']['paypal']['cancel_url_paypal'] = $config['payment']['site_name'] . "/?subtopic=ret";
$config['payment']['paypal']['user_paypal'] = "";
$config['payment']['paypal']['pwd_paypal'] = "";
$config['payment']['paypal']['signature_paypal'] = "";
$config['payment']['paypal']['paypal_sand'] = false; ## Modo de teste true = ativado , false = desativado

// Mercado Pago
$config['payment']['mercadoPago']['client_id'] = "";
$config['payment']['mercadoPago']['client_secret'] = "";
$config['payment']['mercadoPago']['multiplier'] = 2;

# Create Account Options
$config['site']['one_email'] = true;
$config['site']['create_account_verify_mail'] = false;
$config['site']['verify_code'] = false;
$config['site']['email_days_to_change'] = 3;
$config['site']['newaccount_premdays'] = 0;
$config['site']['send_register_email'] = false;

# Create Character Options
// $config['site']['newchar_vocations'][0] = array(1 => 'Sorcerer Sample', 2 => 'Druid Sample', 3 => 'Paladin Sample', 4 => 'Knight Sample');
$config['site']['newchar_vocations'][0] = array(1 => 'Account Manager', 2 => 'Account Manager', 3 => 'Account Manager', 4 => 'Account Manager');
$config['site']['newchar_towns'][0] = array(9);
$config['site']['max_players_per_account'] = 10;


# Emails Config
$config['site']['send_emails'] = true;
$config['site']['mail_address'] = "xxx@xxxx.com.br";
$config['site']['smtp_enabled'] = true;
$config['site']['smtp_host'] = "smtp.xxxxx.com.br";
$config['site']['smtp_port'] = 587;
$config['site']['smtp_auth'] = true;
$config['site']['smtp_user'] = "xxx@xxx.com.br";
$config['site']['smtp_pass'] = "xxx";

# PAGE: whoisonline.php
$config['site']['private-servlist.com_server_id'] = 0;
/*
Server id on 'private-servlist.com' to show Players Online Chart (whoisonline.php page), set 0 to disable Chart feature.
To use this feature you must register on 'private-servlist.com' and add your server.
Format: number, 0 [disable] or higher
*/

# PAGE: characters.php
$config['site']['quests'] = array('Second Promote' => 722423, 'Cursed Skull' => 722424, 'Special Bags' => 722534, 'Headsplitter' => 722420, 'Donate Quest' => 722513, 'Spiritual Aura' => 722640, '5 Level quest' => 722350, 'Hidden Donate Quest' => 722538, 'PvP Task' => 722510, 'Gonka' => 121219, 'Mega Vip' => 53567, 'Hyper Boots' => 5751, 'Ultimate Donation Ring' => 922066, 'Fast Quest' => 56123, 'Mega Ring' => 54631, 'Vip 3' => 722650, 'Under Free Set' => 722702, 'Under Free Shield' => 722701);
$config['site']['show_skills_info'] = false;
$config['site']['show_vip_storage'] = 0;

# PAGE: accountmanagement.php
$config['site']['send_mail_when_change_password'] = false;
$config['site']['send_mail_when_generate_reckey'] = false;
$config['site']['generate_new_reckey'] = true;
$config['site']['generate_new_reckey_price'] = 10;

# PAGE: guilds.php
$config['site']['guild_need_level'] = 8;
$config['site']['guild_need_pacc'] = false;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 2000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 250;

# PAGE: adminpanel.php
$config['site']['access_admin_panel'] = 3;
$config['site']['access_tickers'] = 3;
$config['site']['access_admin_painel'] = 3;
$config['site']['access_staff_painel'] = 3;

# PAGE: latestnews.php
$config['site']['news_limit'] = 5;

# PAGE: killstatistics.php
$config['site']['last_deaths_limit'] = 40;

# PAGE: team.php
$config['site']['groups_support'] = array(2, 3, 4, 5, 6, 7);

# PAGE: highscores.php
$config['site']['groups_hidden'] = array(4, 5, 6, 7);
$config['site']['accounts_hidden'] = array(1, 2);

# PAGE: shopsystem.php
$config['site']['shop_system'] = true;
$config['site']['shopguild_system'] = true;

# PAGE: lostaccount.php
$config['site']['email_lai_sec_interval'] = 180;

# Layout Config
$config['site']['layout'] = 'tibiarl';
$config['site']['vdarkborder'] = '#505050';
$config['site']['darkborder'] = '#D4C0A1';
$config['site']['lightborder'] = '#F1E0C6';
$config['site']['download_page'] = true;
$config['site']['serverinfo_page'] = true;

///Lista de itens Characters
///exemplo
//$config['site']['itensname'] = array(ID DO ITEM => 'DESCRIÇÃO DO ITEM',ID DO ITEM => 'DESCRIÇÃO DO ITEM');
$config['site']['itensname'] = array(
    //PvP Backpack
	12628 => '(club fighting +3, sword fighting +3, axe fighting +3, distance fighting +3, shielding +3, magic level +3, protection all +3%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',
    //PvP Amulet
	11387 => '(club fighting +6, sword fighting +6, axe fighting +6, distance fighting +6, shielding +6, magic level +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',
	//PvP Cursed
	5785 => '(club fighting +6, sword fighting +6, axe fighting +6, distance fighting +6, magic level +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',
    //PvP Mage Legs
	12623 => '(Arm:26, magic level +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',
    //PvP Elite Legs
	2504 => '(Arm:26, club fighting +6, sword fighting +6, axe fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Royal Legs
	5918 => '(Arm:26, distance fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Mage Armor
	12622 => '(Arm:26, magic level +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Elite Armor
	2503 => '(Arm:26, club fighting +6, sword fighting +6, axe fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Royal Armor
	6100 => '(Arm:26, distance fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Mage Helmet
	12621 => '(Arm:26, magic level +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Elite Helmet
	2496 => '(Arm:26, club fighting +6, sword fighting +6, axe fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Royal Helmet
	6099 => '(Arm:26, distance fighting +6, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Mage Book
	12624 => '(Def:80, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Elite Shield
	2538 => '(Def:100, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Royal Shield
	2527 => '(Def:100, protection all +4%).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Club
	7429 => '(Atk:135).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Sword
	7407 => '(Atk:135).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Axe
	2443 => '(Atk:135).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Slingshot
	5907 => '(Atk:140).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Staff
	12288 => '(870~1000).<br><br><font color="green"><b><big>Item VIP</big></b></font>',
    //PvP Mage Boots 
	7892 => '(protection physical +3%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Royal Boots 
	5462 => '(protection physical +3%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Elite Boots 
	2646 => '(protection physical +3%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
    //PvP Mage Ring 
	2123 => '(magic level +6, protection all +4%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>',		
    //PvP Elite Ring
	2121 => '(club fighting +6, sword fighting +6, axe fighting +6, protection all +4%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>',	
	//PvP Royal Ring
	6300 => '(distance fighting +6, protection all +4%, faster regeneration).<br><br><font color="green"><b><big>Item VIP</big></b></font>');
    
$monstersBoost = [
    1 => "Warlock",
    2 => "Dragon Lord",
    3 => "Dawnfire Asura",
    4 => "Draken Abomination",
    5 => "Behemoth",
    6 => "Medusa",
    7 => "Frost Dragon",
    8 => "Demon",
    9 => "Grim Reaper",
    10 => "Serpent Spawn",
    11 => "Hydra",
    12 => "Midnight Asura",
    13 => "Ghastly Dragon",
    14 => "Hellhound",
    15 => "Undead Dragon",
    16 => "Skeleton Elite Warrior",	
    17 => "Draken Elite",		
    18 => "Fury"	
];

$SQLlink = mysqli_connect("localhost", "root", "root", "baiakpvp"); // EDITAVEL -- Muda aqui se tu deixar essa senha nego vai conseguir usar 1 coisinha que pega senha que esqueci o nome pq vc mexeu no mouse oaskdoaskdasodksa

if (!$SQLlink) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
