<?
// ITEM : IMPACT SHARD
$ability = array(
  'ability_name' => 'Impact Shard',
  'ability_token' => 'item-shard-impact',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Items/Impact',
  'ability_class' => 'item',
  'ability_type' => 'impact',
  'ability_description' => 'A mysterious elemental shard that radiates with the Impact type energy of a defeated support mecha.  Collect four of these items to generate a new core that can be thrown in battle to deal Impact type damage or traded in at the shop for a variable amount of Zenny.',
  'ability_energy' => 0,
  'ability_speed' => 10,
  'ability_accuracy' => 100,
  'ability_target' => 'auto',
  'ability_function' => function($objects){
    return mmrpg_ability::item_function_shard($objects);
  }
  );
?>