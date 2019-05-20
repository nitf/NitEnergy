<?php

namespace NitEnergy\event;

use NitEnergy\provider\PlayerData;
use NitEnergy\provider\Provider;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;

class JoinEvent extends Provider implements Listener, PlayerData
{

    /** @var string  */
    const FILE_PATH = "%DATA_PATH%/Player";

    /** @var string  */
    const FILE_NAME = "Player.yml";

    public function __construct()
    {
        parent::__construct(self::FILE_PATH, self::FILE_NAME, null);
    }

    public function onJoin(PlayerJoinEvent $e): void
    {
        $player = $e->getPlayer();
        if (!$this->existsAccount($player))
        {

        }
    }

    /**
     * @param Player $player
     * @return bool
     * Check the account existence.
     */
    public function existsAccount(Player $player): bool
    {
        // TODO: Implement existsAccount() method.
    }

    /**
     * @param Player $player
     */
    public function createAccount(Player $player): void
    {
        // TODO: Implement createAccount() method.
    }

    /**
     * @param Player $player
     */
    public function removeAccount(Player $player): void
    {
        // TODO: Implement removeAccount() method.
    }
}