<?
// ITEM : SMALL SCREW
$item = array(
  'item_name' => 'Small Screw',
  'item_token' => 'small-screw',
  'item_game' => 'MM00',
  'item_class' => 'item',
  'item_description' => 'A small metal screw dropped by a defeated mecha.  This item is loved by a certain robot and can be traded in for a moderate amount of Zenny. ',
  'item_function' => function($objects){

    // Extract all objects into the current scope
    extract($objects);

    // Target this robot's self
    $this_item->target_options_update(array(
      'frame' => 'summon',
      'success' => array(0, 40, -2, 99,
        $this_player->print_player_name().' uses an item from the inventory&hellip; <br />'.
        $target_robot->print_robot_name().' is given the '.$this_item->print_item_name().'!'
        )
      ));
    $target_robot->trigger_target($target_robot, $this_item);

    // Target this robot's self and show the item failing
    $this_item->target_options_update(array(
      'frame' => 'defend',
      'success' => array(9, 0, 0, -10,
        'Nothing happened&hellip;<br />'
        )
      ));
    $this_robot->trigger_target($this_robot, $this_item);

    // Return true on success
    return true;

  }
  );
?>