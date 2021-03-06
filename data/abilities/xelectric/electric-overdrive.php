<?
// ELECTRIC OVERDRIVE
$ability = array(
    'ability_name' => 'Electric Overdrive',
    'ability_token' => 'electric-overdrive',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Weapons/06/Electric',
    'ability_description' => 'The user releases all of their stored weapon energy at once in a powerful storm of lightning shots, dealing Electric type damage to all targets on the opponent\'s side of the field.  This ability\'s power is directly proportionate to the amount of life energy the user has lost, making it most effective when used in critical condition.',
    'ability_type' => 'electric',
    'ability_energy' => 10,
    'ability_energy_percent' => true,
    'ability_accuracy' => 100,
    'ability_function' => function($objects){

        // Call the common overdrive function from here
        return rpg_ability::ability_function_overdrive($objects, 'lightning', 'electrified', 'energized');

        },
    'ability_function_onload' => function($objects){

        // Call the common overdrive onload function from here
        return rpg_ability::ability_function_onload_overdrive($objects);

        }
    );
?>