<?php

include_once('classes\GameCharacterSkills.php');
// include_once('classes\Hero.php');
// include_once('classes\Beast.php');
include_once('classes\CharacterType.php');
include_once('classes\HeroSkills.php');

 

function start_game($numbers_of_game){

    $hero = new Character(CharacterType::$HERO);
    $wild_beast = new Character(CharacterType::$BEAST);
    echo('----game start ---- <br />');

    $hero->print_stats();
    $wild_beast->print_stats();

    $hero_luck = $hero->luck_in_game();
    $wild_beast_luck = $wild_beast->luck_in_game();

    $strike_first = '';

    if($hero->getSpeed() > $wild_beast->getSpeed()){
        $strike_first = CharacterType::$HERO;
        $hero->strike();
        if(!$wild_beast_luck){
            $damage = $hero->damage_deal($hero->getStrenght(), $wild_beast->getDefence());
            if($hero->hero_get_skill(HeroSkills::$RAPID_STRIKE)){
                echo('Rapid Strike <br />');
                $damage = $damage * 2 ; 
            }
            echo ('Damage Deal:'. $damage ."<br />" );
            $wild_beast->setHealth($wild_beast->getHealth() - $damage);
            $hero->print_stats();
            $wild_beast->print_stats();
        }else{
            echo ('Wild_beast is lucky no dmg <br />');
        }
    }elseif($hero->getSpeed() < $wild_beast->getSpeed()){
        $strike_first = CharacterType::$BEAST;
        $wild_beast->strike();
        if(!$hero_luck){
            $damage = $hero->damage_deal($wild_beast->getStrenght(), $hero->getDefence());
            if($hero->hero_get_skill(HeroSkills::$SHIELD)){
                echo('Magic Sheald <br />');
                $damage = 0 ; 
            }
            echo ('Damage Deal:'. $damage ."<br />" );
            $hero->setHealth($hero->getHealth() - $damage);
            $hero->print_stats();
            $wild_beast->print_stats();
        }else{
            echo('Hero is lucky no dmg <br />');
        }
    }else{
        if($hero->getLuck() > $wild_beast->getLuck()){
            $strike_first = CharacterType::$HERO;
            $hero->strike();
            if(!$wild_beast_luck){
                $damage = $hero->damage_deal($hero->getStrenght(), $wild_beast->getDefence());
                if($hero->hero_get_skill(HeroSkills::$RAPID_STRIKE)){
                    echo('Rapid Strike <br />');
                    $damage = $damage * 2 ; 
                }
                echo ('Damage Deal:'. $damage ."<br />" );
                $wild_beast->setHealth($wild_beast->getHealth() - $damage);
                $hero->print_stats();
                $wild_beast->print_stats();
                exit;
            }else{
                echo ('Wild_beast is lucky no dmg <br />');
            }
        }elseif($hero->getLuck() < $wild_beast->getLuck()){
            $strike_first = CharacterType::$BEAST;
            $wild_beast->strike();
            if(!$hero_luck){
                $damage = $hero->damage_deal($wild_beast->getStrenght(), $hero->getDefence());
                if($hero->hero_get_skill(HeroSkills::$SHIELD)){
                    echo('Magic Sheald <br />');
                    $damage = 0 ; 
                }
                echo ('Damage Deal:'. $damage ."<br />" );
                $hero->setHealth($hero->getHealth() - $damage);
                $hero->print_stats();
                $wild_beast->print_stats();
            }else{
                echo('Hero is lucky no dmg <br />');
            }
        }else{
            echo('Speed and luck are even game can`t start. Please try again !<br />');
        }
    }

   
    for($i = 0; $i<=$numbers_of_game ; $i++){

        $hero_luck = $hero->luck_in_game();
        $wild_beast_luck = $wild_beast->luck_in_game();

        echo('------------ new round------ <br />');
        if($strike_first == CharacterType::$BEAST){
            $hero->strike();
            if(!$wild_beast_luck){
                $damage = $hero->damage_deal($hero->getStrenght(), $wild_beast->getDefence());
                if($hero->hero_get_skill(HeroSkills::$RAPID_STRIKE)){
                    echo('Rapid Strike <br />');
                    $damage = $damage * 2 ; 
                }
                echo ('Damage Deal:'. $damage ."<br />" );
                $wild_beast->setHealth($wild_beast->getHealth() - $damage);
                $hero->print_stats();
                $wild_beast->print_stats();
                if($wild_beast->getHealth() <= 0){
                    echo('Hero Win ! <br />');exit;
                }
            }else{
                echo ('Wild_beast is lucky no dmg <br />');
            }
            $strike_first = CharacterType::$HERO;

        }elseif($strike_first = CharacterType::$HERO){
            $wild_beast->strike();
            if(!$hero_luck){
                $damage = $hero->damage_deal($wild_beast->getStrenght(), $hero->getDefence());
                if($hero->hero_get_skill(HeroSkills::$SHIELD)){
                    echo('Magic Sheald <br />');
                    $damage = 0 ; 
                }
                echo ('Damage Deal:'. $damage ."<br />" );
                $hero->setHealth($hero->getHealth() - $damage);
                $hero->print_stats();
                $wild_beast->print_stats();

                if($hero->getHealth() <= 0){
                    echo('Beast Win ! <br />');exit;
                }

            }else{
                echo('Hero is lucky no dmg <br />');
            }
            $strike_first = CharacterType::$BEAST;
        }
    }
    echo('More than 20 rounds, game stop . Draw ! <br />');exit;
}

start_game(20);