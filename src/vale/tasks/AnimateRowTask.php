<?php


namespace vale\tasks;


use pocketmine\inventory\Inventory;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use vale\Core;
use vale\events\CoreListener;
use vale\Utils;

class AnimateRowTask extends Task
{


	public int $seconds = 30;
	/**
	 * @var Player
	 */
	private Player $player;
	/**
	 * @var Inventory
	 */
	private Inventory $inventory;
	/**
	 * @var SlotChangeAction
	 */
	private SlotChangeAction  $action;

	/**
	 * AnimateRowTask constructor.
	 * @param Player $player
	 * @param Inventory $inventory
	 * @param SlotChangeAction $action
	 * @param array $row1
	 */
	public function __construct(Player $player, Inventory $inventory, SlotChangeAction $action, array $row1)
	{
		$this->player = $player;
		$this->inventory = $inventory;
		$this->action = $action;
		$row1 = \vale\utils\Utils::$row1;
	}

	public function onRun(int $currentTick)
	{
		--$this->seconds;
		if ($this->action->getSlot() === 13) {
			foreach (\vale\utils\Utils::$row1 as $rowId1) {
				$this->inventory->setItem($rowId1, \vale\utils\Utils::itemRand("rewards"));
			}
		}
		if ($this->action->getSlot() === 22) {
			foreach (\vale\utils\Utils::$row2 as $rowId2) {
				$this->inventory->setItem($rowId2, \vale\utils\Utils::itemRand("rewards"));
			}
		}
		if ($this->action->getSlot() === 31) {
			foreach (\vale\utils\Utils::$row3 as $rowId3) {
				$this->inventory->setItem($rowId3, \vale\utils\Utils::itemRand("rewards"));
			}
		}
		if ($this->action->getSlot() === 40) {
			foreach (\vale\utils\Utils::$row4 as $rowId4) {
				$this->inventory->setItem($rowId4, \vale\utils\Utils::itemRand("rewards"));
			}
		}
		if ($this->seconds === 0) {
			//todo
			$this->player->sendMessage("DONE");
			Core::getInstance()->getScheduler()->cancelTask($this->getTaskId());
		}
	}

}
