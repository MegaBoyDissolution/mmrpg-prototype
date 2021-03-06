<?
// CRYSTAL MAN
$robot = array(
    'robot_number' => 'DWN-040',
    'robot_game' => 'MM05',
    'robot_name' => 'Crystal Man',
    'robot_token' => 'crystal-man',
    'robot_image_editor' => 18,
    'robot_core' => 'crystal',
    'robot_field' => 'crystal-catacombs',
    'robot_description' => 'Gemstone Counterfeiting Robot',
    'robot_energy' => 100,
    'robot_attack' => 100,
    'robot_defense' => 100,
    'robot_speed' => 100,
    'robot_weaknesses' => array('wind', 'swift'), //gyro-attack,charge-kick
    'robot_resistances' => array('water', 'freeze'),
    'robot_immunities' => array('electric'),
    'robot_abilities' => array(
        'crystal-eye',
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
                array('level' => 0, 'token' => 'crystal-eye')
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