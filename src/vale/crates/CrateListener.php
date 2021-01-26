<?php

namespace vale\crates;

use pocketmine\block\Block;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\types\PlayerListEntry;
use vale\Core;
use vale\utils\Utils;

class CrateListener implements Listener
{

	/** @var Core $plugin */
	public Core $plugin;

	public function __construct(Core $plugin)
	{
		$this->plugin = $plugin;
		$this->plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
	}

	public function onBlockPlaceEvent(BlockPlaceEvent $event)
	{
		$player = $event->getPlayer();
		$inHand = $player->getInventory()->getItemInHand();
		$nbt = $inHand->getNamedTag();
		$date = (string)date('d-m-y');
		$level = (string)$event->getBlock()->getLevel()->getName();
		$block = $event->getBlock();
		if ($nbt->hasTag("EnchanterCharmCrateBlock")) {
			if (Core::getCrateData()->exists("EnchanterCrate")) {
				$player->sendMessage("Block Already Set");
				$event->setCancelled(true);
			} elseif (!Core::getCrateData()->exists("EnchanterCrate")) {
				Core::getCrateData()->set("EnchanterCrate", [
					"cratex" => (int)$block->x,
					"cratey" => (int)$block->y,
					"cratez" => (int)$block->z,
					"level" => (string)$level,
					"name" => (string)$inHand->getCustomName(),
					"DatePlaced" => (string)$date,
					"PlacedBy" => (string)$player->getName(),
				]);
				$player->sendMessage("CRATE BLOCK SET");
				//todo spawn particle
				Core::getCrateData()->save();

			}
		}

	}


	public function antiOpen(PlayerInteractEvent $event)
	{
		$player = $event->getPlayer();
		$block = $event->getBlock();
		$pos = Core::getCrateData()->get("EnchanterCrate");
		$firstpos = $pos["cratex"];
		if ($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK && $block->getX() === $firstpos) {
			$event->setCancelled();
			if (Core::getKeyData()->get($player->getName()) >= 1) {
				Core::reduceKeys($player, 1);
				Utils::sendMenu($player, "ench");
			} else {
				$player->sendMessage("NO KEYS");
			}
		}if($event->getAction() === PlayerInteractEvent::LEFT_CLICK_BLOCK && $block->getX() === $firstpos){
		$player->sendMessage("PREIVEEW");
	}
	}
}
