<?
// SEARCH MAN
$robot = array(
    'robot_number' => 'DWN-061',
    'robot_game' => 'MM08',
    'robot_name' => 'Search Man',
    'robot_token' => 'search-man',
    'robot_image_editor' => 3842,
    'robot_image_size' => 80,
    'robot_core' => 'missile',
    'robot_description' => 'Jungle Commando Robot',
    'robot_energy' => 100,
    'robot_attack' => 100,
    'robot_defense' => 100,
    'robot_speed' => 100,
    'robot_weaknesses' => array('flame', 'explode'),
    'robot_resistances' => array('nature', 'earth'),
    'robot_abilities' => array(
        'homing-sniper',
        'buster-shot',
        'attack-boost', 'attack-break', 'attack-swap', 'attack-mode',
        'defense-boost', 'defense-break', 'defense-swap', 'defense-mode',
        'speed-boost', 'speed-break', 'speed-swap', 'speed-mode',
        'energy-boost', 'energy-break', 'energy-swap', 'energy-mode',
        'field-support', 'mecha-support',
        'light-buster', 'wily-buster', 'cossack-buster'
        ),
    'robot_rewards' => array(
        'abilities' => array(
                array('level' => 0, 'token' => 'homing-sniper')
            )
        ),
    'robot_quotes' => array(
        'battle_start' => '',
        'battle_taunt' => '',
        'battle_victory' => '',
        'battle_defeat' => ''
        )
    );
?>