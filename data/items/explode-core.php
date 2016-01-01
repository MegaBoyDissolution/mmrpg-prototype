<?
// ITEM : EXPLODE CORE
$ability = array(
  'ability_name' => 'Explode Core',
  'ability_token' => 'item-core-explode',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Items/Explode',
  'ability_class' => 'item',
  'ability_subclass' => 'holdable',
  'ability_type' => 'explode',
  'ability_description' => 'A mysterious elemental core that radiates with the Explode type energy of a defeated robot master.  When held by another robot, this item allows the user to equip any Explode type ability.  This item is also coveted by a certain character and can be traded in for a variable amount of Zenny.',
  'ability_energy' => 0,
  'ability_speed' => 10,
  'ability_accuracy' => 100,
  'ability_target' => 'auto',
  'ability_function' => function($objects){
    return rpg_ability::item_function_core($objects);
  }
  );
?>