<?php

class Character 
{
    private int $health;
    private int $strenght;
    private int $defance;
    private int $speed;
    private int $luck;
    private string $rapid_strike;
    private string $magic_shield;
    private static $rapid_strike_chance = 10;
    private static $magic_shield_chance = 20;
    private string $type_character;

    public function __construct($type_character){
        // erou personaj pozitiv (true)
        if($type_character ===  CharacterType::$HERO){
            $this->health = mt_rand(70,100);
            $this->strenght = mt_rand(70,80);
            $this->defance = mt_rand(45,55);
            $this->speed = mt_rand(40,50);
            $this->luck =  mt_rand(10,30);
            $this->type_character = CharacterType::$HERO;
            $this->rapid_strike = HeroSkills::$RAPID_STRIKE;
            $this->magic_shield = HeroSkills::$SHIELD;

        }
        // erou peronaj negativ (false)
        elseif($type_character  === CharacterType::$BEAST){
            $this->health = mt_rand(60,90);
            $this->strenght = mt_rand(60,90);
            $this->defance = mt_rand(40,60);
            $this->speed = mt_rand(40,60);
            $this->luck = mt_rand(25,40);
            $this->type_character = CharacterType::$BEAST;
        } else {
            throw 'Invalid character type';
        }
    }

    public function setHealth($health){
        $this->health = $health;
    }

    public function getType(){
        return $this->type_character;
    }

    public function getHealth(){
        return $this->health;
    }

    public function getStrenght(){
        return $this->strenght;
    }

    public function getDefence(){
        return $this->defance;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function getLuck(){
        return $this->luck;
    }

    public function luck_in_game(){
        switch($this->type_character) {
            case CharacterType::$HERO:
                return (round(mt_rand(1, (1 / $this->luck) * 100)) == 1);
            break;
            case CharacterType::$BEAST:
                return (round(mt_rand(1, (1 / $this->luck) * 100)) == 1);
            break;
        }
    }

    public function hero_get_skill($special_skill){
        switch($special_skill){
            case HeroSkills::$RAPID_STRIKE:
                return (round(mt_rand(1, (1 / self::$rapid_strike_chance) * 100)) == 1);
            break;
            case HeroSkills::$SHIELD:
                return (round(mt_rand(1, (1 / self::$magic_shield_chance) * 100)) == 1);
            break;
        }
    }

    public function damage_deal($power = null, $defense = null){
        $dmg = $power - $defense;
        switch($this->type_character){
            case CharacterType::$HERO:
                $get_rapid_strike = $this->hero_get_skill($this->rapid_strike);
                if($get_rapid_strike){
                    echo('Rapid Strike <br />');
                    $dmg += $dmg;
                }
                return  $dmg;
                break;
            case CharacterType::$BEAST:
                $get_shield = $this->hero_get_skill(HeroSkills::$SHIELD);
                if($get_shield){
                    echo('Magic Sheald <br />');
                    $dmg = 0;
                }
                return  $dmg;
                break;
        }
            return false ;
    }

    public function strike($defender,$strenght,$defence){
        switch($this->type_character){
            case CharacterType::$HERO:
                echo('----Hero start attack---- <br />');
                $damage = $this->damage_deal($strenght,$defence);
                echo ('Damage Deal:'. $damage ."<br />" );
                $defender->setHealth($this->health - $damage);
                break;
            case CharacterType::$BEAST:
                echo('----Beast start attack---- <br />');
                $damage =  $this->damage_deal($strenght,$defence);
                echo ('Damage Deal:'. $damage ."<br />" );
                $defender->setHealth($this->health - $damage);
                break;
        }
    }

    public function print_stats(){
        switch($this->type_character){
            case CharacterType::$HERO:
                echo('----Hero stats---- <br />');
                break;
            case CharacterType::$BEAST:
                echo('----Beast stats---- <br />');
                break;
        }
        echo("Health: ".$this->health . '<br />');
        echo("Strenght: ".$this->strenght. '<br />');
        echo("Defance: ".$this->defance. '<br />');
        echo("Speed: ".$this->speed. '<br />');
        echo("Luck: ".$this->luck. '<br />');
    }
}