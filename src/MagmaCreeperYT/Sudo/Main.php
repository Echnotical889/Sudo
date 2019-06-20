<?php

namespace MagmaCreeperYT\Sudo;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as c;

class Main extends PluginBase implements Listener {

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($command->getName() === "sudo"){
            if(!$sender->hasPermission("sudo.command")){
                $sender->sendMessage(c::RED."You don't have permission to use this command!");
                return true;
            }elseif(count($args) < 2){
                $sender->sendMessage(c::RED."Usage: /sudo <player> <command | c:message>");
                return true;
            }else{
                $player = $this->getServer()->getPlayer($args[0]);
                if($player === null){
                    $sender->sendMessage(c::RED.$args[0]." is not online!");
                    return true;
                }else{
                    if($args[1][0] === "c" && $args[1][1] === ":"){
                        $message = implode(" ", array_slice($args, 1, 1000));
                        $message = str_replace("c:", "", $message);
                        $player->chat($message);
                        return true;
                    }else{
                        $cmd = implode(" ", array_slice($args, 1, 1000));
                        $this->getServer()->dispatchCommand($player, $cmd);
                        return true;
                    }
                }
            }
        }
    return true;
    }
}