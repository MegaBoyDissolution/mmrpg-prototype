<?

// PLAYER DATABASE

// Define the index of hidden players to not appear in the database
$hidden_database_players = array();
$hidden_database_players = array_merge($hidden_database_players, array('player'));
$hidden_database_players_count = !empty($hidden_database_players) ? count($hidden_database_players) : 0;

// Collect the database players
$mmrpg_database_players = $mmrpg_index['players'];

// Remove unallowed players from the database
foreach ($mmrpg_database_players AS $temp_token => $temp_info){
  if (in_array($temp_token, $hidden_database_players)){
    unset($mmrpg_database_players[$temp_token]);
  } else {
    // Ensure this player's image exists, else default to the placeholder
    if (file_exists(MMRPG_CONFIG_ROOTDIR.'images/players/'.$temp_token.'/')){ $mmrpg_database_players[$temp_token]['player_image'] = $temp_token; }
    else { $mmrpg_database_players[$temp_token]['player_image'] = 'player'; }
  }
}

// Sort the player index based on player number
function mmrpg_index_sort_players($player_one, $player_two){
  if ($player_one['player_number'] > $player_two['player_number']){ return 1; }
  elseif ($player_one['player_number'] < $player_two['player_number']){ return -1; }
  elseif ($player_one['player_token'] > $player_two['player_token']){ return 1; }
  elseif ($player_one['player_token'] < $player_two['player_token']){ return -1; }
  else { return 0; }
}
uasort($mmrpg_database_players, 'mmrpg_index_sort_players');

// Determine the token for the very first player in the database
$temp_player_tokens = array_values($mmrpg_database_players);
$first_player_token = array_shift($temp_player_tokens);
$first_player_token = $first_player_token['player_token'];
unset($temp_player_tokens);

// Count the number of players collected and filtered
$mmrpg_database_players_count = count($mmrpg_database_players);

// Loop through the database and generate the links for these players
$key_counter = 0;
$mmrpg_database_players_links = '';
$mmrpg_database_players_links_counter = 0;
$mmrpg_database_players_links_counter_incomplete = 0;
foreach ($mmrpg_database_players AS $player_key => $player_info){
  // If a type filter has been applied to the player page
  if (isset($this_current_filter) && $this_current_filter == 'none' && $player_info['player_type'] != ''){ $key_counter++; continue; }
  elseif (isset($this_current_filter) && $this_current_filter != 'none' && $player_info['player_type'] != $this_current_filter){ $key_counter++; continue; }
  // Collect the player sprite dimensions
  $player_image_size = !empty($player_info['player_image_size']) ? $player_info['player_image_size'] : 40;
  $player_image_size_text = $player_image_size.'x'.$player_image_size;
  $player_image_token = !empty($player_info['player_image']) ? $player_info['player_image'] : $player_info['player_token'];
  $player_image_incomplete = $player_image_token == 'player' ? true : false;
  $player_is_active = !empty($this_current_token) && $this_current_token == $player_info['player_token'] ? true : false;
  $player_title_text = $player_info['player_name'].' | '.(!empty($player_info['player_type']) ? ucfirst($player_info['player_type']).' Type' : 'Neutral Type');
  $player_image_path = 'images/players/'.$player_image_token.'/mug_right_'.$player_image_size_text.'.png?'.MMRPG_CONFIG_CACHE_DATE;
  $player_type_token = $player_info['player_type'];

  // Start the output buffer and collect the generated markup
  ob_start();
  ?>
  <div title="<?= $player_title_text ?>" data-token="<?= $player_info['player_token'] ?>" class="float float_left float_link player_type player_type_<?= $player_type_token ?><?= $player_image_incomplete  ? ' incomplete' : '' ?>">
    <a class="sprite sprite_player_link sprite_player sprite_player_sprite sprite_40x40 sprite_40x40_mugshot sprite_size_40x40 player_status_active player_position_active <?= $player_key == $first_player_token ? 'sprite_player_current ' : '' ?>" href="<?='database/players/'.$player_info['player_token'].'/'?>" rel="<?= $player_image_incomplete ? 'nofollow' : 'follow' ?>">
      <? if($player_image_token != 'player'): ?>
        <img src="<?= $player_image_path ?>" width="<?= $player_image_size ?>" height="<?= $player_image_size ?>" alt="<?= $player_title_text ?>" />
      <? else: ?>
        <span><?= $player_info['player_name'] ?></span>
      <? endif; ?>
    </a>
  </div>
  <?
  $mmrpg_database_players_links .= preg_replace('/\s+/', ' ', trim(ob_get_clean()))."\n";
  $mmrpg_database_players_links_counter++;
  if ($player_image_incomplete){ $mmrpg_database_players_links_counter_incomplete++; }
  $key_counter++;
}

?>