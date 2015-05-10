<?
// ITEM : SHADOW STAR
$ability = array(
  'ability_name' => 'Shadow Star',
  'ability_token' => 'item-star-shadow',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Items/Shadow',
  'ability_class' => 'item',
  'ability_type' => 'shadow',
  'ability_description' => 'A mysterious elemental star that radiates with the Shadow type energy of a distant planet. Collecting a single one of these items permanently grants +'.MMRPG_SETTINGS_STARS_ATTACKBOOST.' Attack toward and +'.MMRPG_SETTINGS_STARS_DEFENSEBOOST.' Defense against all Shadow type damage, but only if there are no Dark Elements on the field to suppress it\'s effects.  A certain character is said to be researching these items and would likely trade a respectable amount of Zenny to study one up close.',
  'ability_energy' => 0,
  'ability_speed' => 10,
  'ability_accuracy' => 100,
  'ability_target' => 'auto',
  'ability_function' => function($objects){
    return mmrpg_ability::item_function_core($objects);
  }
  );
?>