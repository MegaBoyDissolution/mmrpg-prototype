<?
// SPEED FADE
$ability = array(
  'ability_name' => 'Speed Fade',
  'ability_token' => 'speed-fade',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Support/18/LaserSpeed',
  'ability_description' => 'The user breaks down the target\'s mobility systems using an effecient beams program, lowering its speed by {DAMAGE}%!',
  'ability_energy' => 4,
  'ability_damage' => 20,
  'ability_damage_percent' => true,
  'ability_type' => 'laser',
  'ability_accuracy' => 95,
  'ability_function' => function($objects){

    // Call the common elemental stat boost function from here
    return mmrpg_ability::ability_function_elemental_speed_break($objects, 'faded', 'glowed');

    },
  'ability_function_onload' => function($objects){

    // Call the common elemental stat boost onload function from here
    return mmrpg_ability::ability_function_onload_elemental_speed_break($objects);

    }
  );
?>