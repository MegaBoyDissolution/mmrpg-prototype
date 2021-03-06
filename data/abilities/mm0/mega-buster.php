<?
// MEGA BUSTER
$ability = array(
    'ability_name' => 'Mega Buster',
    'ability_token' => 'mega-buster',
    'ability_game' => 'MM00',
    'ability_group' => 'MM00/Weapons/Mega',
    'ability_description' => 'The user charges on the first turn to build power and raise defense by {RECOVERY2}%, then releases a powerful energy shot on the second to inflict massive damage!',
    'ability_energy' => 2,
    'ability_damage' => 36,
    'ability_recovery2' => 10,
    'ability_recovery2_percent' => true,
    'ability_accuracy' => 100,
    'ability_target' => 'auto',
    'ability_function' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // Define this ability's attachment token
        $this_attachment_token = 'ability_'.$this_ability->ability_token;
        $this_attachment_info = array(
            'class' => 'ability',
            'ability_token' => $this_ability->ability_token,
            'ability_frame' => 0,
            'ability_frame_animate' => array(1, 2, 1, 0),
            'ability_frame_offset' => array('x' => -10, 'y' => -10, 'z' => -20)
            );
        // Loop through each existing attachment and alter the start frame by one
        foreach ($this_robot->robot_attachments AS $key => $info){ array_push($this_attachment_info['ability_frame_animate'], array_shift($this_attachment_info['ability_frame_animate'])); }

        // Check if this ability is already charged
        $is_charged = isset($this_robot->robot_attachments[$this_attachment_token]) ? true : false;

        // If the user is holding a Charge Module, auto-charge the ability
        if ($this_robot->has_item('charge-module')){ $is_charged = true; }

        // If the ability flag was not set, this ability begins charging
        if (!$is_charged){

            // Target this robot's self
            $this_ability->target_options_update(array(
                'frame' => 'defend',
                'success' => array(1, -10, 0, -10, $this_robot->print_name().' charges the '.$this_ability->print_name().'&hellip;')
                ));
            $this_robot->trigger_target($this_robot, $this_ability);

            // Increase this robot's defense stat slightly
            $this_ability->recovery_options_update(array(
                'kind' => 'defense',
                'percent' => true,
                'rates' => array(100, 0, 0),
                'success' => array(2, -10, 0, -10, $this_robot->print_name().'&#39;s shields powered up!'),
                'failure' => array(2, -10, 0, -10, $this_robot->print_name().'&#39;s shields were not affected&hellip;')
                ));
            $defense_recovery_amount = ceil($this_robot->robot_defense * ($this_ability->ability_recovery2 / 100));
            $this_robot->trigger_recovery($this_robot, $this_ability, $defense_recovery_amount);

            // Attach this ability attachment to the robot using it
            $this_robot->robot_attachments[$this_attachment_token] = $this_attachment_info;
            $this_robot->update_session();

        }
        // Else if the ability flag was set, the ability is released at the target
        else {

            // Remove this ability attachment to the robot using it
            unset($this_robot->robot_attachments[$this_attachment_token]);
            $this_robot->update_session();

            // Update this ability's target options and trigger
            $this_ability->target_options_update(array(
                'frame' => 'shoot',
                'kickback' => array(-5, 0, 0),
                'success' => array(3, 100, -15, 10, $this_robot->print_name().' fires the '.$this_ability->print_name().'!'),
                ));
            $this_robot->trigger_target($target_robot, $this_ability);

            // Inflict damage on the opposing robot
            $this_ability->damage_options_update(array(
                'kind' => 'energy',
                'kickback' => array(20, 0, 0),
                'success' => array(3, -110, -15, 10, 'A massive energy shot hit the target!'),
                'failure' => array(3, -110, -15, -10, 'The '.$this_ability->print_name().' shot missed&hellip;')
                ));
            $energy_damage_amount = $this_ability->ability_damage;
            $target_robot->trigger_damage($this_robot, $this_ability, $energy_damage_amount);

        }

        // Return true on success
        return true;

        },
    'ability_function_onload' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // Define this ability's attachment token
        $this_attachment_token = 'ability_'.$this_ability->ability_token;

        // Check if this ability is already charged
        $is_charged = isset($this_robot->robot_attachments[$this_attachment_token]) ? true : false;

        // If the ability flag had already been set, reduce the weapon energy to zero
        if ($is_charged){ $this_ability->set_energy(0); }
        // Otherwise, return the weapon energy back to default
        else { $this_ability->reset_energy(); }

        // If the user is holding a Charge Module, auto-charge the ability
        if ($this_robot->has_item('charge-module')){ $is_charged = true; }

        // If the user is holding a Target Module, allow bench targeting
        if ($is_charged && $this_robot->has_item('target-module')){ $this_ability->set_target('select_target'); }
        else { $this_ability->reset_target(); }

        // Return true on success
        return true;

        }
    );
?>