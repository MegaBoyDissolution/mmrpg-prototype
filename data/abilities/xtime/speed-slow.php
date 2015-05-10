<?
// SPEED SLOW
$ability = array(
  'ability_name' => 'Speed Slow',
  'ability_token' => 'speed-slow',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Support/07/TimeSpeed',
  'ability_description' => 'The user breaks down the target\'s mobility systems using an effecient temporal program, lowering its speed by {DAMAGE}%!',
  'ability_energy' => 4,
  'ability_damage' => 10,
  'ability_damage_percent' => true,
  'ability_type' => 'time',
  'ability_accuracy' => 95,
  'ability_function' => function($objects){

    // Call the common elemental stat boost function from here
    return mmrpg_ability::ability_function_elemental_speed_break($objects, 'slowed', 'hastened');

    },
  'ability_function_onload' => function($objects){

    // Call the common elemental stat boost onload function from here
    return mmrpg_ability::ability_function_onload_elemental_speed_break($objects);

    }
  );
?>