<?php

include_once('classes\Character.php');
include_once('classes\CharacterType.php');
include_once('classes\HeroSkills.php');

 

function start_game($numbers_of_game){

    $hero = new Character(CharacterType::$HERO);
    $wild_beast = new Character(CharacterType::$BEAST);
    echo('----game start ---- <br />');

    $hero->print_stats();
    $wild_beast->print_stats();

    $hero_luck = $hero->luck();
    $wild_beast_luck = $wild_beast->luck();

    $strike_first = '';

    if($hero->getSpeed() > $wild_beast->getSpeed()){
        $strike_first = CharacterType::$HERO;

        if(!$wild_beast_luck){
            $hero->strike($wild_beast);
            $hero->print_stats();
            $wild_beast->print_stats();
        }else{
            echo('----Hero start attack----');
            echo ('Wild_beast is lucky no dmg <br />');
        }

    }elseif($hero->getSpeed() < $wild_beast->getSpeed()){
        $strike_first = CharacterType::$BEAST;

        if(!$hero_luck){
            $wild_beast->strike($hero);
            $hero->print_stats();
            $wild_beast->print_stats();
        }else{
            echo('----Wild_beast start attack----');
            echo('Hero is lucky no dmg <br />');
        }

    }else{
        if($hero->getLuck() > $wild_beast->getLuck()){
            $strike_first = CharacterType::$HERO;

            if(!$wild_beast_luck){
                $hero->strike($wild_beast);
                $hero->print_stats();
                $wild_beast->print_stats();
            }else{
                echo('----Hero start attack---- <br />');
                echo ('Wild_beast is lucky no dmg <br />');
            }

        }elseif($hero->getLuck() < $wild_beast->getLuck()){
            $strike_first = CharacterType::$BEAST;

            if(!$hero_luck){
                $wild_beast->strike($hero);
                $hero->print_stats();
                $wild_beast->print_stats();
            }else{
                echo('----Wild_beast start attack---- <br />');
                echo('Hero is lucky no dmg <br />');
            }

        }else{
            echo('Speed and luck are even game can`t start. Please try again !<br />');
        }
    }

   
    for($i = 1; $i<=$numbers_of_game ; $i++){

        $hero_luck = $hero->luck();
        $wild_beast_luck = $wild_beast->luck();

        echo('------------New Round Number:'.$i.' ------ <br />');

        if($strike_first == CharacterType::$BEAST){
            $strike_first = CharacterType::$HERO;

            if(!$wild_beast_luck){
                $hero->strike($wild_beast);
                $hero->print_stats();
                $wild_beast->print_stats();

                if($wild_beast->getHealth() <= 0){
                    echo('Hero Win ! <br />');exit;
                }

            }else{
                echo('----Hero start attack---- <br />');
                echo ('Wild_beast is lucky no dmg <br />');
            }

            $strike_first = CharacterType::$HERO;

        }elseif($strike_first = CharacterType::$HERO){
            $strike_first = CharacterType::$BEAST;

            if(!$hero_luck){
                $wild_beast->strike($hero);
                $hero->print_stats();
                $wild_beast->print_stats();

                if($hero->getHealth() <= 0){
                    echo('Beast Win ! <br />');exit;
                }

            }else{
                echo('----Wild_beast start attack---- <br />');
                echo('Hero is lucky no dmg <br />');
            }

            $strike_first = CharacterType::$BEAST;
        }
    }
    echo('More than 20 rounds, game stop . Draw ! <br />');exit;
}

start_game(20);