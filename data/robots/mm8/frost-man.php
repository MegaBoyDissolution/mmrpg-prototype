<?
// FROST MAN
$robot = array(
    'robot_number' => 'DWN-062',
    'robot_game' => 'MM08',
    'robot_name' => 'Frost Man',
    'robot_token' => 'frost-man',
    'robot_core' => 'freeze',
    'robot_description' => 'Frozen Brute Robot',
    'robot_energy' => 100,
    'robot_attack' => 100,
    'robot_defense' => 100,
    'robot_speed' => 100,
    'robot_weaknesses' => array('explode', 'flame'),
    'robot_resistances' => array('freeze', 'water'),
    'robot_abilities' => array(
        'ice-wave',
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
                array('level' => 0, 'token' => 'ice-wave')
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