<?
// ELECTRIC SHOT
$ability = array(
    'ability_name' => 'Electric Shot',
    'ability_token' => 'electric-shot',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Weapons/06/Electric',
    'ability_description' => 'The user fires a small lightning shot at the target to inflict Electric type damage. This ability\'s power increases if the user if holding a buster charge of the same element.',
    'ability_type' => 'electric',
    'ability_energy' => 0,
    'ability_damage' => 20,
    'ability_accuracy' => 100,
    'ability_function' => function($objects){

        // Call the common shot function from here
        return rpg_ability::ability_function_shot($objects, 'lightning', 'zapped', 'charged');

        },
    'ability_function_onload' => function($objects){

        // Call the common shot onload function from here
        return rpg_ability::ability_function_onload_shot($objects);

        }
    );
?>