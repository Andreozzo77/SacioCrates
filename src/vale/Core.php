<?php

namespace vale;

use muqsit\invmenu\InvMenuHandler;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginLoader;
use pocketmine\plugin\PluginLogger;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\MainLogger;
use vale\crates\CrateListener;
use vale\events\CoreListener;

class Core extends PluginBase
{

	/** @var Core $instance */
	public static  $instance;
	/** @var Config $crateData */
	public static $crateData;
	/** @var Config $keyData */
	public static $keyData;

	public function onEnable(): void
	{
		if (!InvMenuHandler::isRegistered()) {
			InvMenuHandler::register($this);
		}
		self::$instance = $this;
		self::$crateData = new Config($this->getDataFolder() . "Crates.yml", Config::YAML);
		self::$keyData = new Config($this->getDataFolder() . "KeyData.yml", Config::YAML);
		new CoreListener($this);
		new CrateListener($this);
		MainLogger::getLogger()->info("TEST ENABLED XDDD");
	}

	public static function getInstance(): Core
	{
		return self::$instance;
	}

	public static function getCrateData(): Config
	{
		return self::$crateData;
	}

	public static function getKeyData(): Config
	{
		return self::$keyData;
	}

	public static function initKeyDataBase(Player $player)
	{
		if (!self::getKeyData()->exists($player->getName())) {
			self::getKeyData()->set($player->getName(), 0);
			self::getKeyData()->save();
		}
	}
	public static function addKeys(Player $player, int $value)
	{
		$currentKeys = self::getKeyData()->get($player->getName());
		self::getKeyData()->set($player->getName(), $currentKeys + $value);
		self::getKeyData()->save();
	}

	public static function setKeys(Player $player, int $value)
	{
		self::$keyData->set($player->getName(), $value);
		self::getKeyData()->save();
	}

	public static function reduceKeys(Player $player, int $value)
	{
		$currentKeys = self::getKeyData()->get($player->getName());
		self::getKeyData()->set($player->getName(), $currentKeys - $value);
		self::getKeyData()->save();
	}

	public static function getCrateKeys(Player $player)
	{
		$keys = self::getKeyData()->get($player->getName());
		$player->sendMessage("Your keys" . (int)$keys);

	}
}
