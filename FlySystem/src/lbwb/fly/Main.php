<?php

namespace lbwb\fly;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{
    public $cfx;
    protected function onEnable(): void
    {
        $this->getLogger()->info("§eActivated");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->cfx = $this->getConfig();
        $this->saveDefaultConfig();
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch ($command->getName()){
            case "fly":
                if($this->getConfig()->get($sender->getName())){
                    $sender->setAllowFlight(false);
                    $sender->setFlying(false);
                    $this->getConfig()->remove($sender->getName());
                    $this->getConfig()->save();
                    $this->getConfig()->reload();
                    $sender->sendMessage("§bYou activated flight fode");
                }else{
                 $this->getConfig()->set($sender->getName());
                 $sender->setAllowFlight(true);
                 $sender->setFlying(true);
                 $this->getConfig()->save();
                 $this->getConfig()->reload();
                 $sender->sendMessage("§bYou Deactivated flight mode");

                }
        }
        return true;
    }
}