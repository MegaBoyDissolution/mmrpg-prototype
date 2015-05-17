<?
// DEFENSE HASTE
$ability = array(
  'ability_name' => 'Defense Haste',
  'ability_token' => 'defense-haste',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Support/07/TimeDefense',
  'ability_description' => 'The user powers up its own shield systems with a defensive temporal program, raising defense by {RECOVERY}%!',
  'ability_energy' => 4,
  'ability_recovery' => 10,
  'ability_recovery_percent' => true,
  'ability_type' => 'time',
  'ability_accuracy' => 100,
  'ability_function' => function($objects){

    // Call the common elemental stat boost function from here
    return mmrpg_ability::ability_function_elemental_defense_boost($objects, 'hastened', 'slowed');

    },
  'ability_function_onload' => function($objects){

    // Call the common elemental stat boost onload function from here
    return mmrpg_ability::ability_function_onload_elemental_defense_boost($objects);

    }
  );
?>