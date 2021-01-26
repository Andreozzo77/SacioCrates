<?php

namespace vale\utils;

use muqsit\invmenu\inventory\InvMenuInventory;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\MenuIds;
use muqsit\invmenu\SharedInvMenu;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use vale\Core;
use pocketmine\utils\Color;
use pocketmine\item\enchantment\EnchantmentInstance;
use vale\tasks\AnimateRowTask;
use vale\utils\BaseCrate;

class Utils extends BaseCrate
{

	/** @var SharedInvMenu $menu */
	public static $menu;
	public static $row1 = [9,10,11,12,13,14,15,16,17];
	public static $row2 = [18,19,20,21,22,23,24,25,26];
	public static $row3 = [27,28,29,30,31,32,33,34,35];
	public static $row4 = [36,37,38,39,40,41,42,43,45];

	public static function sendMenu(Player $player, string $type)
	{
		switch ($type) {
			case "ench":
				self::$menu = InvMenu::create(MenuIds::TYPE_DOUBLE_CHEST);
				parent::baseCrateMenu(self::$menu->getInventory(), $type);
				self::$menu->setListener(function (Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) {
					if ($action->getSlot() === 13 && self::$menu->getInventory()->getItem($action->getSlot())->getNamedTag()->hasTag("REWARD")) {
						Core::getInstance()->getScheduler()->scheduleRepeatingTask(new AnimateRowTask($player, $action->getInventory(), $action, self::$row1), 30);
					}
						if ($action->getSlot() === 22 && self::$menu->getInventory()->getItem($action->getSlot())->getNamedTag()->hasTag("REWARD")) {
							Core::getInstance()->getScheduler()->scheduleRepeatingTask(new AnimateRowTask($player, $action->getInventory(), $action, self::$row2), 30);
						}
							if ($action->getSlot() === 31 && self::$menu->getInventory()->getItem($action->getSlot())->getNamedTag()->hasTag("REWARD")) {
								Core::getInstance()->getScheduler()->scheduleRepeatingTask(new AnimateRowTask($player, $action->getInventory(), $action, self::$row3), 30);
							}
								if ($action->getSlot() === 40 && self::$menu->getInventory()->getItem($action->getSlot())->getNamedTag()->hasTag("REWARD")) {
									Core::getInstance()->getScheduler()->scheduleRepeatingTask(new AnimateRowTask($player, $action->getInventory(), $action, self::$row4), 30);
								}
				});
				self::$menu->setName("TEST");
				self::$menu->readonly(true);
				self::$menu->send($player);
		}
	}

	public static function itemRand(string $items)
	{
		switch ($items) {
			case "rewards":
				$hsword = Item::get(Item::DIAMOND_SWORD);
				$hsword->setCustomName("§r§dHeroic Diamond Sword");
				$hsword->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantmentByName("sharpness"),1));
				$hboots = Item::get(Item::DIAMOND_BOOTS);
				$hboots->setCustomName("§r§dHeroic Diamond Boots");
				$hboots->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantmentByName("protection"),1));
				$godlychest = Item::get(Item::CHEST);
				$godlychest->setCustomName("§r§c§lGodly §r§cSpace Chest");
				$heroricchest = Item::get(Item::CHEST);
				$heroricchest->setCustomName("§r§d§lHeroric §r§dSpace Chest");
				$legenchest = Item::get(Item::CHEST);
				$legenchest->setCustomName("§r§6§lLegendary §r§6Space Chest");
				$phantomhelm = Item::get(Item::LEATHER_HELMET, 0, 1);
				$phantomhelm->setCustomName("§r§c§lPhantom Hood");
				$phantomhelm->setCustomColor(new Color(255,0,0));
				$phantomhelm->setLore([
					"§r§cThe fabled hood of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",
				]);
				$phantomchest = Item::get(Item::LEATHER_CHESTPLATE, 0, 1);
				$phantomchest->setCustomColor(new Color(255,0,0));
				$phantomchest->setCustomName("§r§c§lPhantom Plate");
				$phantomchest->setLore([
					"§r§cThe fabled plate of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",
				]);
				$phantomleg = Item::get(Item::LEATHER_LEGGINGS, 0, 1);
				$phantomleg->setCustomColor(new Color(255,0,0));
				$phantomleg->setCustomName("§r§c§lPhantom Robes");
				$phantomleg->setLore([
					"§r§cThe fabled robes of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",

				]);
				$phantomboot = Item::get(Item::LEATHER_BOOTS, 0, 1);
				$phantomboot->setCustomColor(new Color(255,0,0));
				$phantomboot->setCustomName("§r§c§lPhantom Boots");
				$phantomboot->setLore([
					"§r§cThe fabled robes of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",

				]);

				$sword = Item::get(Item::DIAMOND_SWORD);
				$sword->setCustomName("§r§c§lPhantom Sword");
				$sword->setLore([
					"§r§c§lPHANTOM SWORD",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",
				]);
				$Yijikihelm = Item::get(Item::LEATHER_HELMET, 0, 1);
				$Yijikihelm->setCustomName("§r§b§lYijiki Hood");
				$Yijikihelm->setCustomColor(new Color(0,0,255));
				$Yijikihelm->setLore([
					"§r§bThe fabled hood of the Yijiki",
					"§r§b§lYijiki SET BONUS",
					"§r§b§l* §r§bDeal +35% more damage to outgoing enemies",
					"§r§b§l* §r§b20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL Yijiki SET PIECES))",
				]);
				$Yijikichest = Item::get(Item::LEATHER_CHESTPLATE, 0, 1);
				$Yijikichest->setCustomColor(new Color(0,0,255));
				$Yijikichest->setCustomName("§r§b§lYijiki Plate");
				$Yijikichest->setLore([
					"§r§bThe fabled plate of the Yijiki",
					"§r§b§lYijiki SET BONUS",
					"§r§b§l* §r§bDeal +35% more damage to outgoing enemies",
					"§r§b§l* §r§b20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL Yijiki SET PIECES))",
				]);
				$Yijikileg = Item::get(Item::LEATHER_LEGGINGS, 0, 1);
				$Yijikileg->setCustomColor(new Color(0,0,255));
				$Yijikileg->setCustomName("§r§b§lYijiki Robes");
				$Yijikileg->setLore([
					"§r§bThe fabled robes of the Yijiki",
					"§r§b§lYijiki SET BONUS",
					"§r§b§l* §r§bDeal +35% more damage to outgoing enemies",
					"§r§b§l* §r§b20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL Yijiki SET PIECES))",

				]);
				$Yijikiboot = Item::get(Item::LEATHER_BOOTS, 0, 1);
				$Yijikiboot->setCustomColor(new Color(0,0,255));
				$Yijikiboot->setCustomName("§r§b§lYijiki Boots");
				$Yijikiboot->setLore([
					"§r§bThe fabled robes of the Yijiki",
					"§r§b§lYijiki SET BONUS",
					"§r§b§l* §r§bDeal +35% more damage to outgoing enemies",
					"§r§b§l* §r§b20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL Yijiki SET PIECES))",

				]);

				$ysword = Item::get(Item::DIAMOND_SWORD);
				$ysword->setCustomName("§r§b§lYijiki Sword");
				$ysword->setLore([
					"§r§b§lYijiki SWORD",
					"§r§b§l* §r§bDeal +35% more damage to outgoing enemies",
					"§r§b§l* §r§b20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL Yijiki SET PIECES))",

				]);
				$gkit1 = Item::get(Item::DIAMOND);
				$gkit1->setCustomName("§6§lEVOLUTION KIT");
				$mask = Item::get(Item::PUMPKIN);
				$mask->setCustomName("§r§4§lOverlord §r§7Mask");
				$godapple = Item::get(Item::ENCHANTED_GOLDEN_APPLE);

				break;
		}
		$rewards = [$hsword, $hboots,$godlychest,$heroricchest,$legenchest,$phantomchest,$phantomboot,$phantomleg,$phantomhelm,$sword,$Yijikiboot,$Yijikichest,$Yijikihelm,$Yijikiboot,$ysword,$gkit1,$mask,$godapple];
		$reward = $rewards[array_rand($rewards)];

		return $reward;
	}

	public static function sendCrateParticles(Player $player, string $crate)
	{
		switch ($crate) {
			case "OTHER":
				break;
			case "ENCHANTER":
				break;
			case "ALL":
				if (Core::getCrateData()->exists("EnchanterCrate")) {
					$pos = Core::getCrateData()->get("EnchanterCrate");
					$firstpos = $pos["cratex"];
					$secondpos = $pos["cratey"];
					$thirdpos = $pos["cratez"];
					$enchanterText = Core::getKeyData()->get($player->getName());
					$enchparticle = new FloatingTextParticle(new Vector3($firstpos, $secondpos, $thirdpos), $enchanterText);
					$player->getLevel()->addParticle($enchparticle);
					break;
				}

		}
	}
}
