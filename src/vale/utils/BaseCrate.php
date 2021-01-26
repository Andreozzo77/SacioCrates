<?php

namespace vale\utils;

use muqsit\invmenu\inventory\InvMenuInventory;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;

class BaseCrate{

	/** @var array $outSideGrid */
	public static array $outSideGrid = [];


	public static function baseCrateMenu(InvMenuInventory $menu, string $type){
		switch ($type){
			case "ench":
                $star = Item::get(Item::NETHERSTAR);
                $click = Item::get(160,5,1);
                $click->setCustomName("§r§a§l(§r§a!§r§a§l) §r§aClick to start!");
                $click->setLore([
                	'§r§a§l* §r§7This will begin this rows roll.',
				]);
                $click->getNamedTag()->setTag(new StringTag("REWARD"));
				self::$outSideGrid = range(0,8);
				unset(self::$outSideGrid[4]);
				foreach (self::$outSideGrid as $outSideGridId){
					$menu->setItem($outSideGridId, Item::get(241,7,1));
				}
				$secondSide = range(45,53);
				unset($secondSide[49]);
				foreach ($secondSide as $secondSideId){
					$menu->setItem($secondSideId, Item::get(241,7,1));
				}
				$menu->setItem(49,$star);
				$menu->setItem(4,$star);
				$menu->setItem(13,$click);
				$menu->setItem(22,$click);
				$menu->setItem(31,$click);
				$menu->setItem(40,$click);
				break;

		}
	}

}
