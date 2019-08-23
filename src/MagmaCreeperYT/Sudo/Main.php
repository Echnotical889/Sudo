<?php

namespace MagmaCreeperYT\Sudo;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Main extends PluginBase {

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
                $argss = "";
                foreach($args as $arg){
                    if(strpos($arg, " ") !== false){
                        $argss = $argss."\"".$arg."\" ";
                    }else{
                        $argss = $argss.$arg." ";
                    }
                }
                $player->chat($argss);
                return true;
            }
        }
    return true;
    }
}
