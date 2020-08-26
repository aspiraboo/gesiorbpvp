<?php
if(!defined('INITIALIZED'))
	exit;

// DEFINE VARIABLES FOR SCRIPTS AND LAYOUTS (no more notices 'undefinied variable'!)
if(!isset($_REQUEST['subtopic']) || empty($_REQUEST['subtopic']) || is_array($_REQUEST['subtopic']))
{
	$_REQUEST['subtopic'] = "latestnews";
}
else
	$_REQUEST['subtopic'] = (string) $_REQUEST['subtopic'];

if(Functions::isValidFolderName($_REQUEST['subtopic']))
{
	if(Website::fileExists("pages/" . $_REQUEST['subtopic'] . ".php"))
	{
		$subtopic = $_REQUEST['subtopic'];
	}
	else
		new Error_Critic('CRITICAL ERROR', 'Cannot load page <b>' . htmlspecialchars($_REQUEST['subtopic']) . '</b>, file does not exist.');
}
else
	new Error_Critic('CRITICAL ERROR', 'Cannot load page <b>' . htmlspecialchars($_REQUEST['subtopic']) . '</b>, invalid file name [contains illegal characters].');

// action that page should execute
if(isset($_REQUEST['action']))
	$action = (string) $_REQUEST['action'];
else
	$action = '';

$logged = false;
$account_logged = new Account();
$group_id_of_acc_logged = 0;
// with ONLY_PAGE option we want disable useless SQL queries
if(!ONLY_PAGE)
{
	// logged boolean value: true/false
	$logged = Visitor::isLogged();
	// Account object with account of logged player or empty Account
	$account_logged = Visitor::getAccount();
	// group of acc. logged
	if(Visitor::isLogged())
		$group_id_of_acc_logged = Visitor::getAccount()->getPageAccess();
}
$layout_name = './layouts/' . Website::getWebsiteConfig()->getValue('layout');

$title = Website::getServerConfig()->getValue('serverName') . ' - '.ucwords($subtopic);

$topic = $subtopic;

$passwordency = Website::getServerConfig()->getValue('encryptionType');
if($passwordency == 'plain')
	$passwordency = '';

$news_content = '';
$vocation_name = array();
foreach(Website::getVocations() as $vocation)
{
	$vocation_name[$vocation->getPromotion()][$vocation->getBaseId()] = $vocation->getName();
}

$layout_ini = parse_ini_file($layout_name.'/layout_config.ini');
foreach($layout_ini as $key => $value)
	$config['site'][$key] = $value;

//###################### FUNCTIONS ######################
function microtime_float()
{
	return microtime(true);
}

function isPremium($premdays, $lastday)
{
	return Functions::isPremium($premdays, $lastday);
}

function saveconfig_ini($config)
{
	new Error_Critic('', 'function <i>saveconfig_ini</i> is deprecated. Do not use it.');
}

function password_ency($password, $account = null)
{
	new Error_Critic('', 'function <i>password_ency</i> is deprecated. Do not use it.');
}

function check_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- [ ] '");
	if($temp != strlen($name))
		return false;
	if(strlen($name) > 25)
		return false;

	return true;
}

function check_account_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "QWERTYUIOPASDFGHJKLZXCVBNM0123456789");
	if ($temp != strlen($name))
		return false;
	if(strlen($name) < 1)
		return false;
	if(strlen($name) > 32)
		return false;

	return true;
}

function check_name_new_char($name)
{
	$name = (string) $name;
	$name_to_check = strtolower($name);
	//first word can't be:
	$first_words_blocked = array('gm ','cm ', ' ', 'god ','tutor ', "'", '-');
	//names blocked:
	$names_blocked = array('gm','cm', "'", 'god', 'tutor');
	//name can't contain:
	$words_blocked = array('gamemaster', 'game master', 'game-master', "game'master", '--','-', "''","' ", " '", "'", '- ', ' -', "-'", "'-", 'fuck', 'sux', 'suck', 'god', 'adm', 'noob', 'tutor', 'dragon',  'penguin', 
'the frog prince', 
'skunk', 
'grynch clan goblin', 
'badger', 
'rat',
'sem name',
'name',
'sem nome',
'nome',
'sem',
'captain vip',
'rashid',
'xodet',
'alesar',
'hakata',
'yaman',
'haroun',
'captain greyhound',
'captain fearless',
'captain seahorse',
'karith',
'jack fate',
'atrad',
'training assistant',
'benjamin',
'towncryer',
'captain',
'thief',
'tormented ghost', 
'undead jester', 
'shard of corruption', 
'bat', 
'snake', 
'cave rat', 
'enraged squirrel', 
'thieving squirrel', 
'spider', 
'dwarf henchman', 
'wolf', 
'community',
'manage',
'manager',
'administrador',
'admin',
'otserv',
'otserver',
'bug', 
'resetar', 
'resetando', 
'resetou', 
'resetava', 
'reseta', 
'azure frog', 
'coral frog', 
'crimson frog', 
'orchid frog', 
'island troll', 
'hyaena', 
'winter wolf', 
'troll', 
'sandcrawler', 
'poison spider', 
'panda', 
'frost troll', 
'bear', 
'munster', 
'wasp', 
'spit nettle', 
'swamp troll', 
'orc', 
'goblin', 
'polar bear', 
'crab', 
'cobra', 
'lion', 
'essence of darkness', 
'centipede', 
'dworc venomsniper', 
'dworc fleshhunter', 
'skeleton', 
'frostfur', 
'crazed beggar', 
'goblin scavenger', 
'orc spearman', 
'crocodile', 
'tiger', 
'rotworm', 
'chakoya toolshaper', 
'chakoya tribewarden', 
'troll champion', 
'rottie the rotworm', 
'insect swarm', 
'elf', 
'larva', 
'scorpion', 
'dwarf', 
'hacker', 
'primitive', 
'skeleton warrior', 
'undead mine worker', 
'smuggler', 
'chakoya windcaller', 
'dworc voodoomaster', 
'minotaur', 
'orc warrior', 
'bloodpaw', 
'tibia bug', 
'goblin assassin', 
'mad technomancer', 
'war wolf', 
'wild warrior', 
'toad', 
'amazon', 
'nomad', 
'bovinus', 
'dwarf miner', 
'gnarlhound', 
'boar', 
'minotaur archer', 
'bandit', 
'carrion worm', 
'dwarf soldier', 
'achad', 
'poacher', 
'gang member', 
'teleskor', 
'elf scout', 
'rotworm queen', 
'goblin leader', 
'valkyrie', 
'ghoul', 
'pirate skeleton', 
'barbarian skullhunter', 
'barbarian headsplitter', 
'undead prospector', 
'tortoise', 
'gazer', 
'stalker', 
'barbarian brutetamer', 
'colerian the barbarian', 
'gladiator', 
'damaged worker golem', 
'novice of the cult', 
'quara mantassin scout', 
'dark apprentice', 
'sibang', 
'assassin', 
'big boss trolliver', 
'lizard sentinel', 
'orc shaman', 
'orc rider', 
'fire devil', 
'kongra', 
'the hairy one', 
'tarantula', 
'scarab', 
'witch', 
'ghost', 
'dire penguin', 
'pirate marauder', 
'axeitus headbanger', 
'troll legionnaire', 
'merlkin', 
'dark monk', 
'thornback tortoise', 
'terror bird', 
'carniphila', 
'gargoyle', 
'mummy', 
'minotaur mage', 
'cyclops', 
'hunter', 
'apprentice sheng', 
'frost giant', 
'frost giantess', 
'mutated human', 
'the snapper', 
'lizard templar', 
'blood crab', 
'slime', 
'minotaur guard', 
'stone golem', 
'elephant', 
'mammoth', 
'morik the gladiator', 
'killer rabbit', 
'terramite', 
'dwarf guard', 
'vampire pig', 
'smuggler baron silvertoe', 
'bonelord', 
'pirate cutthroat', 
'elf arcanist', 
'mercury blob', 
'gozzler', 
'dark magician', 
'dragon hatchling', 
'furious troll', 
'rocky', 
'dryad', 
'hot dog', 
'infernal frog', 
'crypt shambler', 
'orc berserker', 
'barbarian bloodwalker', 
'monk', 
'quara constrictor scout', 
'the horned fox', 
'cyclops drone', 
'the big bad one', 
'doom deer', 
'mad scientist', 
'orc marauder', 
'lizard snakecharmer', 
'blue djinn', 
'green djinn', 
'cursed gladiator', 
'orcus the cruel', 
'fire elemental', 
'berserker chicken', 
'demon parrot', 
'demon skeleton', 
'evil sheep', 
'hide', 
'quara constrictor', 
'pirate ghost', 
'pirate buccaneer', 
'acid blob', 
'inky', 
'cyclops smith', 
'xenia', 
'mechanical fighter', 
'dwarf geomancer', 
'orc leader', 
'renegade orc', 
'lancer beetle',
'elder bonelord', 
'zombie', 
'ice golem', 
'acolyte of the cult', 
'general murius', 
'death blob', 
'diseased bill', 
'diseased dan', 
'diseased fred', 
'the bloodtusk', 
'vampire', 
'avalanche', 
'haunted treeling', 
'marid', 
'efreet', 
'doctor perhaps', 
'hairman the huge', 
'evil sheep lord', 
'pirate corsair', 
'kreebosh the exile', 
'barbaria', 
'dirtbeard', 
'nightslayer', 
'dharalion', 
'rukor zad', 
'quara mantassin', 
'quara predator scout', 
'adept of the cult', 
'cublarc the plunderer', 
'mephiles', 
'priestess ', 
'the dark dancer', 
'foreman kneebiter', 
'blazing fire elemental', 
'charged energy elemental', 
'slick water elemental', 
'earth elemental', 
'muddy earth elemental', 
'mutated rat', 
'the weakened count', 
'bride of night', 
'wailing widow', 
'the collector', 
'yeti', 
'boogey', 
'enlightened of the cult', 
'lethal lissy', 
'ron the ripper', 
'brutus bloodbeard', 
'deadeye devious', 
'nightstalker', 
'splasher', 
'ungreez', 
'the hag', 
'wyvern', 
'high templar cobrass', 
'heoni', 
'undead minion', 
'energy elemental', 
'bane bringer', 
'monstor', 
'bonebeast', 
'necromancer', 
'ice witch', 
'slim', 
'quara pincher scout', 
'fernfang', 
'esmeralda', 
'undead cavebear', 
'mutated bat', 
'dragon lord hatchling', 
'water elemental', 
'shardhead', 
'orc warlord', 
'grimgor guteater', 
'evil mastermind', 
'dragon', 
'drasilla', 
'glitterscale', 
'ancient scarab', 
'frost dragon hatchling', 
'the evil eye', 
'mutated tiger', 
'the old whooper', 
'midnight warrior',
'man in the cave', 
'stampor', 
'quara hydromancer scout', 
'quara hydromancer', 
'spirit of earth', 
'bog raider', 
'undead gladiator', 
'killer caiman', 
'captain jones', 
'spirit of water', 
'lich', 
'giant spider', 
'banshee', 
'crystal spider', 
'brimstone bug', 
'spirit of fire', 
'massive fire elemental', 
'massive energy elemental', 
'massive earth elemental', 
'braindeath', 
'young sea serpent', 
'necropharus', 
'vampire bride', 
'massive water elemental', 
'lizard legionnaire', 
'rift worm', 
'quara pincher', 
'hero', 
'webster', 
'worker golem', 
'blistering fire elemental', 
'roaring water elemental', 
'overcharged energy elemental', 
'jagged earth elemental', 
'souleater', 
'lizard dragon priest', 
'nightmare scion', 
'grandfather tridian', 
'lizard high guard', 
'fahim the wise', 
'merikh the slaughterer', 
'wyrm', 
'quara predator', 
'black knight', 
'darakan the executioner', 
'sharptooth', 
'arthei', 
'rift brood', 
'warlord ruzad', 
'lizard zaogun', 
'the count', 
'thul', 
'sir valorcrest', 
'zevelon duskbringer', 
'arachir the ancient one', 
'diblis the fair', 
'boreth', 
'lersatio', 
'eternal guardian', 
'crustacea gigantica', 
'werewolf', 
'rift scythe', 
'dragon lord', 
'hydra', 
'spectre', 
'frost dragon', 
'norgle glacierbeard', 
'nightmare', 
'lizard chosen', 
'sea serpent', 
'grorlam', 
'gravelord oshuran', 
'draken warmaster', 
'draptor', 
'behemoth', 
'destroyer', 
'the pit lord', 
'marziel', 
'hellspawn', 
'duskbringer', 
'draken spellweaver', 
'tiquandas revenge', 
'war golem', 
'earth overlord', 
'energy overlord', 
'fire overlord', 
'ice overlord', 
'dipthrah', 
'diabolic imp', 
'omruc', 
'thalas', 
'vashresamun', 
'morguthis', 
'svoren the mad', 
'baron brute', 
'the axeorcist', 
'serpent spawn', 
'mahrdis', 
'the keeper', 
'ashmunrah', 
'rahemos', 
'menace', 
'fatality', 
'betrayed wraith', 
'the masked marauder', 
'stonecracker', 
'incineron', 
'coldheart', 
'fluffy', 
'defiler', 
'bones', 
'dreadwing', 
'doomhowl', 
'draken abomination', 
'hellfire fighter', 
'warlock', 
'minishabaal', 
'lost soul', 
'gnorre chyllson', 
'infernalist', 
'the many', 
'haunter', 
'the dreadorian', 
'medusa', 
'the old widow', 
'draken elite', 
'rocko', 
'tremorak', 
'phantasm', 
'fallen mooh', 
'yakchal', 
'fury', 
'plaguesmith', 
'fury', 
'tirecz', 
'ghastly dragon', 
'dark torturer', 
'hand of cursed fate', 
'leviathan', 
'deathbringer', 
'grim reaper', 
'blightwalker', 
'son of verminor', 
'demon', 
'demodras', 
'the obliverator', 
'azerus', 
'the noxious spawn', 
'hellhound', 
'undead dragon', 
'mr punish', 
'the imperor', 
'lord of the elements', 
'zarabustor', 
'the plasmother', 
'juggernaut', 
'zulazza the corruptor', 
'orshabaal', 
'the handmaiden', 
'annihilon', 
'hellgorak', 
'madareth', 
'ushuriel', 
'zugurosh', 
'dracola', 
'ferumbras', 
'morgaroth', 
'ghazbaran', 
'exura', 
'exiva', 
'exori', 
'exana', 
'utevo', 
'exevo', 
'adori', 
'adura', 
'exana', 
'utito', 
'utamo', 
'the mutated pumpkin');
	foreach($first_words_blocked as $word)
		if($word == substr($name_to_check, 0, strlen($word)))
			return false;
	if(substr($name_to_check, -1) == "'" || substr($name_to_check, -1) == "-")
		return false;
	if(substr($name_to_check, 1, 1) == ' ')
		return false;
	if(substr($name_to_check, -2, 1) == " ")
		return false;
	foreach($names_blocked as $word)
		if($word == $name_to_check)
			return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i-1] == ' ' && $name_to_check[$i+1] == ' ')
			return false;
	foreach($words_blocked as $word)
		if (!(strpos($name_to_check, $word) === false))
			return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i] == $name_to_check[($i+1)] && $name_to_check[$i] == $name_to_check[($i+2)])
			return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i-1] == ' ' && $name_to_check[$i+1] == ' ')
			return false;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- '");
	if ($temp != strlen($name))
		return false;
	if(strlen($name) < 4)
		return false;
	if(strlen($name) > 19)
		return false;

	return true;
}

function check_rank_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-[ ] ");
	if($temp != strlen($name))
		return false;
	if(strlen($name) < 2)
		return false;
	if(strlen($name) > 19)
		return false;

	return true;
}

function check_guild_name($name)
{
	$name = (string) $name;
	$words_blocked = array('--', "''","' ", " '", '- ', ' -', "-'", "'-", '  ');
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-' ");
	if($temp != strlen($name))
		return false;
	if(strlen($name) < 1)
		return false;
	if(strlen($name) > 21)
		return false;

	foreach($words_blocked as $word)
		if (!(strpos($name, $word) === false))
			return false;

	return true;
}

function check_password($pass)
{
	$pass = (string) $pass;
	$temp = strspn("$pass", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890");
	if($temp != strlen($pass))
		return false;
	if(strlen($pass) > 32)
		return false;

	return true;
}

function check_mail($email)
{
	$email = (string) $email;
	$ok = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}/";
	return (preg_match($ok, $email))? true: false;
}

function items_on_player($characterid, $pid)
{
	new Error_Critic('', 'function <i>items_on_player</i> is deprecated. Do not use it. It used too many queries!');
}

function getReason($reasonId)
{
	return Functions::getBanReasonName($reasonId);
}

//################### DISPLAY FUNCTIONS #####################
//return shorter text (news ticker)
function short_text($text, $chars_limit) 
{
	if(strlen($text) > $chars_limit)
		return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")).'...';
	else
		return $text;
}
//return text to news msg
function news_place()
{
	return '';
}
//set monster of week
function logo_monster()
{
	new Error_Critic('', 'function <i>logo_monster</i> is deprecated. Do not use it!');
}

// // we don't want to count AJAX scripts/guild images as page views, we also don't need status
// if(!ONLY_PAGE)
// {
// 	// STATUS CHECKER
// 	$statustimeout = 1;
// 	foreach(explode("*", str_replace(" ", "", $config['server']['statusTimeout'])) as $status_var)
// 		if($status_var > 0)
// 			$statustimeout = $statustimeout * $status_var;
// 	$statustimeout = $statustimeout / 1000;
// 	$config['status'] = parse_ini_file('cache/DONT_EDIT_serverstatus.txt');
// 	if($config['status']['serverStatus_lastCheck']+$statustimeout < time())
// 	{
// 		$config['status']['serverStatus_checkInterval'] = $statustimeout+3;
// 		$config['status']['serverStatus_lastCheck'] = time();
// 		$statusInfo = new ServerStatus($config['server']['ip'], $config['server']['statusPort'], 1);
// 		if($statusInfo->isOnline())
// 		{
// 			$config['status']['serverStatus_online'] = 1;
// 			$config['status']['serverStatus_players'] = $statusInfo->getPlayersCount();
// 			$config['status']['serverStatus_playersMax'] = $statusInfo->getPlayersMaxCount();
// 			$h = floor($statusInfo->getUptime() / 3600);
// 			$m = floor(($statusInfo->getUptime() - $h*3600) / 60);
// 			$config['status']['serverStatus_uptime'] = $h.'h '.$m.'m';
// 			$config['status']['serverStatus_monsters'] = $statusInfo->getMonsters();
// 		}
// 		else
// 		{
// 			$config['status']['serverStatus_online'] = 0;
// 			$config['status']['serverStatus_players'] = 0;
// 			$config['status']['serverStatus_playersMax'] = 0;
// 		}
// 		$file = fopen("cache/DONT_EDIT_serverstatus.txt", "w");
// 		$file_data = '';
// 		foreach($config['status'] as $param => $data)
// 		{
// 	$file_data .= $param.' = "'.str_replace('"', '', $data).'"
// 	';
// 		}
// 		rewind($file);
// 		fwrite($file, $file_data);
// 		fclose($file);
// 	}
// 	//PAGE VIEWS COUNTER
// 	$views_counter = "cache/DONT_EDIT_usercounter.txt";
// 	// checking if the file exists
// 	if (file_exists($views_counter))
// 	{
// 		$actie = fopen($views_counter, "r+"); 
// 		$page_views = fgets($actie, 9); 
// 		$page_views++; 
// 		rewind($actie); 
// 		fputs($actie, $page_views, 9); 
// 		fclose($actie); 
// 	}
// 	else
// 	{ 
// 		// the file doesn't exist, creating a new one with value 1
// 		$actie = fopen($views_counter, "w"); 
// 		$page_views = 1; 
// 		fputs($actie, $page_views, 9); 
// 		fclose($actie); 
// 	}
// }