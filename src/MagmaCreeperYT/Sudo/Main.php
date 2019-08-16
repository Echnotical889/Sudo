<?php

namespace MagmaCreeperYT\Sudo;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener {

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        if($command->getName() === "sudo"){
            if(!$sender->hasPermission("sudo.command")){
                $sender->sendMessage("§cYou don't have permission to use this command!");
                return true;
            }elseif(count($args) < 2){
                $sender->sendMessage("§cUsage: /sudo <player> <message | /command>");
                return true;
            }elseif(($player = $this->getServer()->getPlayer(array_shift($args))) === null){
                $sender->sendMessage("§cPlayer not found!");
                return true;
            }else{
                $player->chat(implode(" ", $args));
                return true;
            }
        }
    return true;
    }
}