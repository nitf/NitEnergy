<?php

namespace NitEnergy;

use NitEnergy\command\EnergyCommand;
use NitEnergy\event\JoinEvent;
use NitEnergy\game\Debug\Debug;
use NitEnergy\game\GameHandler;
use NitEnergy\game\OpenGameTask;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskScheduler;

class Main extends PluginBase implements Listener
{

    /** @var $path */
    private static $path;

    /** @var TaskScheduler */
    private static $scheduler;

    public function onLoad(): void
    {
        date_default_timezone_set('Asia/Tokyo');
    }

    public function onEnable(): void
    {
        self::$path = $this->getDataFolder();
        self::$scheduler = $this->getScheduler();
        if (!file_exists(self::$path)) {
            @mkdir(self::$path);
        }
        $listeners = [
            new JoinEvent()
        ];
        $server = $this->getServer();
        foreach ($listeners as $listener) {
            $server->getPluginManager()->registerEvents($listener, $this);
        }
        $server->getCommandMap()->register("nitenergy", new EnergyCommand());
        $games = [
            "Debug" => Debug::class
        ];
        foreach ($games as $gameName => $path) {
            GameHandler::registerGame($gameName, $path);
        }
        $this->getScheduler()->scheduleRepeatingTask(new OpenGameTask(), 20 * 1);
    }

    /**
     * @return string
     */
    public static function getPath(): string
    {
        return self::$path;
    }

    /**
     * @return TaskScheduler
     */
    public static function _getScheduler(): TaskScheduler
    {
        return self::$scheduler;
    }
}