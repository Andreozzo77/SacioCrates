<?php
namespace vale\events;

use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;
use vale\Core;
use vale\utils\Utils;

class CoreListener implements Listener
{

	public Core $core;

	public function __construct(Core $core)
	{
		$this->core = $core;
		$this->core->getServer()->getPluginManager()->registerEvents($this, $core);
	}

	/*public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		Core::initKeyDataBase($player);
		Utils::sendCrateParticles($player, "ALL");
		Core::setKeys($player, 10);
		$block = Item::get(Item::CHEST,0,64);
		$nbt =  $block->getNamedTag();
		$nbt->setTag(new StringTag("EnchanterCharmCrateBlock"));
		$block->setCustomName("CRATE BLOCK");
		$player->getInventory()->addItem($block);
	}
}*/
