<?
// ITEM : ENERGY CORE
$item = array(
    'item_name' => 'Energy Core',
    'item_token' => 'energy-core',
    'item_game' => 'MMRPG',
    'item_group' => 'MMRPG/Items/Energy',
    'item_class' => 'item',
    'item_subclass' => 'holdable',
    'item_type' => 'energy',
    'item_description' => 'A mysterious elemental core that radiates with the Life energy of a defeated robot master.',
    'item_description_shop' => 'This item appears to be coveted by a certain character and can be traded in for a variable amount of Zenny.',
    'item_energy' => 0,
    'item_speed' => 10,
    'item_accuracy' => 100,
    'item_price' => 3000,
    'item_target' => 'auto',
    'item_function' => function($objects){
        return rpg_item::item_function_core($objects);
    }
    );
?>