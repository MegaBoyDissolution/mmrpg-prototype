
/* -- MAP GENERATOR JAVASCRIPT -- */

// Define global object variables
var fieldOptions = null;
var fieldCounters = null;
var fieldMap = null;
var fieldMapEventGrid = null;
var fieldMovesRemaining = null;
var fieldPointsCurrent = null;
var fieldPointsTotal = null;
var fieldCompletePercent = null;
var firstCell = null;
var firstCellRow = 0;
var firstCellCol = 0;

// Define move counter variables
var allowedMoves = 0;
var usedMoves = 0;
var remainingMoves = 0;

// Define target counters
var mechasTotal = 0;
var robotsTotal = 0;
var bossesTotal = 0;

// Define target defeat counters
var mechasDefeated = 0;
var robotsDefeated = 0;
var bossesDefeated = 0;

// Define target move values
var mechaMovesValue = 1;
var robotMovesValue = 2;
var bossMovesValue = 0; //3;

// Define target point values
var mechaPointsValue = 10;
var robotPointsValue = 100;
var bossPointsValue = 1000;

// Define the point counters
var currentPoints = 0;
var totalPoints = 0;

// Define the completion percent
var completePercent = 0;

$(document).ready(function(){

    // Collect referneces to key elements

    fieldOptions = $('#window .field_options');

    fieldCounters = $('#window .field_counters');
    fieldMovesRemaining = $('.counter.moves .remaining', fieldCounters);
    fieldPointsCurrent = $('.counter.points .current', fieldCounters);
    fieldPointsTotal = $('.counter.points .total', fieldCounters);
    fieldCompletePercent = $('.counter.complete .percent', fieldCounters);

    fieldMap = $('#window .field_map');
    fieldMapEventGrid = $('.event_grid', fieldMap);

    firstCell = $('.cell.origin', fieldMapEventGrid);
    firstCellRow = parseInt(firstCell.attr('data-row'));
    firstCellCol = parseInt(firstCell.attr('data-col'));

    // Define a click event for the map reset button
    var resetButton = $('input[name="reset"][type="button"]', fieldOptions);
    resetButton.bind('click', function(e){
        e.preventDefault();

        // Reset internal counters to zero
        usedMoves = 0;
        mechasDefeated = 0;
        robotsDefeated = 0;
        bossesDefeated = 0;
        currentPoints = 0;

        // Remove any complete classes from bodies
        fieldCounters.removeClass('complete success failure');
        fieldMap.removeClass('complete success failure');

        // Reset the classes for each of the map cells
        $('.cell', fieldMapEventGrid).removeClass('enabled complete');

        // Update field counter calculations
        updateFieldCounters();

        // Re-enable the orgin cell and it's adjacent neighbours
        firstCell.addClass('enabled complete');
        enableAdjacentCells(firstCellRow, firstCellCol);

        return true;
        });

    // Define a click event for the map generator button
    var regenerateButton = $('input[name="regenerate"][type="button"]', fieldOptions);
    regenerateButton.bind('click', function(e){
        e.preventDefault();
        var actionBase = fieldOptions.find('form').attr('action');
        var scaleValue = fieldOptions.find('select[name="scale"]').val();
        var playerValue = fieldOptions.find('select[name="player"]').val();
        var fieldValue = fieldOptions.find('select[name="field"]').val();
        var bossValue = fieldOptions.find('select[name="boss"]').val();
        //console.log('actionBase', actionBase);
        //console.log('scaleValue', scaleValue);
        //console.log('playerValue', playerValue);
        //console.log('fieldValue', fieldValue);
        //console.log('bossValue', bossValue);
        var redirectURL = [actionBase];
        if (scaleValue.length){ redirectURL.push('scale='+scaleValue); }
        if (playerValue.length){ redirectURL.push('player='+playerValue); }
        if (fieldValue.length){ redirectURL.push('field='+fieldValue); }
        if (bossValue.length){ redirectURL.push('boss='+bossValue); }
        //console.log('redirectURL', redirectURL);
        redirectURL = redirectURL.join('&');
        //console.log('redirectURL', redirectURL);
        window.location.href = redirectURL;
        return true;
        });

    // Define a click event for the cells of the field map
    $('.cell', fieldMapEventGrid).bind('click', function(e){
        e.preventDefault();

        // If the battle is already complete, do nothing
        if (fieldMap.hasClass('complete')){ return false; }

        // Collect a reference to the current cell
        var thisCell = $(this);

        // Check if this cell is already complete
        var isComplete = thisCell.hasClass('complete') ? true : false;

        // Only proceed if cell is not already complete
        if (!isComplete && remainingMoves > 0){

            // Collect the current cell row and col co-ordinates
            var thisCellRow = parseInt(thisCell.attr('data-row'));
            var thisCellCol = parseInt(thisCell.attr('data-col'));

            // Collect adjacent cells to the clicked one
            var adjacentCellPositions = getAdjacentCells(thisCellRow, thisCellCol);

            // Loop through adjacent cells to see if any of them are complete
            var adjacentToCompleted = false;
            for (i = 0; i < adjacentCellPositions.length; i++){
                var adjacentCellPos = adjacentCellPositions[i];
                var adjacentCell = $('.cell[data-row="'+adjacentCellPos[0]+'"][data-col="'+adjacentCellPos[1]+'"]', fieldMapEventGrid);
                if (adjacentCell.hasClass('complete')){ adjacentToCompleted = true; }
                }

            // Check to see if this cell is adjacent to a completed one
            if (adjacentToCompleted){

                // Add the complete class to the cell
                $(this).addClass('complete');

                // Enable all cells adjacent to this one
                enableAdjacentCells(thisCellRow, thisCellCol);

                // Increment the number of used moves and recalculate
                usedMoves += 1;
                updateFieldCounters();

                // Check if this cell has a mecha in it
                if (thisCell.find('.event.mecha').length){
                    mechasDefeated += 1;
                    updateFieldCounters();
                    }
                // Check if this cell has a robot in it
                else if (thisCell.find('.event.robot').length){
                    robotsDefeated += 1;
                    updateFieldCounters();
                    }
                // Check if this cell has a robot in it
                else if (thisCell.find('.event.boss').length){
                    bossesDefeated += 1;
                    updateFieldCounters();
                    }

                // Update the game status after recent changes
                updateGameStatus();

                } else {

                    // It's not adjacent so return false
                    return false;

                }


            } else {

            // It's already complete so return false
            return false;

            }

        });

    // Automatically enable cells around the starting point
    firstCell.addClass('enabled');
    enableAdjacentCells(firstCellRow, firstCellCol);

    // Update target mecha/robot/boss counters at start
    mechasTotal = $('.event.mecha', fieldMapEventGrid).length;
    robotsTotal = $('.event.robot', fieldMapEventGrid).length;
    bossesTotal = $('.event.boss', fieldMapEventGrid).length;

    // Calculate point totals for the field at start
    totalPoints = 0;
    totalPoints += mechasTotal * mechaPointsValue;
    totalPoints += robotsTotal * robotPointsValue;
    totalPoints += bossesTotal * bossPointsValue;
    fieldPointsTotal.html(totalPoints);
    console.log('totalPoints = ', totalPoints);

    // Trigger the field count update function at start
    updateFieldCounters();


});


// Define a function for getting adjacent cells
function getAdjacentCells(thisCellRow, thisCellCol){
    console.log('getAdjacentCells(' + thisCellRow + ', ' + thisCellCol + ')');

    // Collect a reference to the requested cell
    var thisCell = $('.cell[data-row="'+thisCellRow+'"][data-col="'+thisCellCol+'"]', fieldMapEventGrid);

    // Define the positions of adjacent cells to the current
    var thisUpCellPos = [(thisCellRow - 1), thisCellCol];
    var thisRightCellPos = [thisCellRow, (thisCellCol + 1)];
    var thisBottomCellPos = [(thisCellRow + 1), thisCellCol];
    var thisLeftCellPos = [thisCellRow, (thisCellCol - 1)];
    var adjacentCellPositions = [thisUpCellPos, thisRightCellPos, thisBottomCellPos, thisLeftCellPos];

    //console.log('thisUpCellPos', thisUpCellPos);
    //console.log('thisRightCellPos', thisRightCellPos);
    //console.log('thisBottomCellPos', thisBottomCellPos);
    //console.log('thisLeftCellPos', thisLeftCellPos);
    //console.log('adjacentCellPositions', adjacentCellPositions);

    // Return the collected adjacent cells
    return adjacentCellPositions;

}

// Define a function for enabling adjacent cells
function enableAdjacentCells(thisCellRow, thisCellCol){
    //console.log('enableAdjacentCells(' + thisCellRow + ', ' + thisCellCol + ')');

    // Collect a reference to the requested cell
    var thisCell = $('.cell[data-row="'+thisCellRow+'"][data-col="'+thisCellCol+'"]', fieldMapEventGrid);

    // Collect adjacent cell positions
    var adjacentCellPositions = getAdjacentCells(thisCellRow, thisCellCol);

    // Loop through adjacent cells to see if any of them are complete
    for (i = 0; i < adjacentCellPositions.length; i++){
        var adjacentCellPos = adjacentCellPositions[i];
        var adjacentCell = $('.cell[data-row="'+adjacentCellPos[0]+'"][data-col="'+adjacentCellPos[1]+'"]', fieldMapEventGrid);
        if (!adjacentCell.length){ continue; }
        if (!adjacentCell.hasClass('complete')){
            adjacentCell.removeClass('enabled');
            void adjacentCell.get(0).offsetWidth;
            }
        adjacentCell.addClass('enabled');
        //console.log('add enabled status to .cell[data-row="'+adjacentCellPos[0]+'"][data-col="'+adjacentCellPos[1]+'"]');
        }

    // Return return on complete
    return true;

}

// Define a function for updating moves counters
function updateFieldCounters(){
    console.log('updateFieldCounters()');

    console.log('allowedMoves = ', allowedMoves);
    console.log('usedMoves = ', usedMoves);

    console.log('mechasTotal = ', mechasTotal);
    console.log('robotsTotal = ', robotsTotal);
    console.log('bossesTotal = ', bossesTotal);

    console.log('mechasDefeated = ', mechasDefeated);
    console.log('robotsDefeated = ', robotsDefeated);
    console.log('bossesDefeated = ', bossesDefeated);

    // Recalculate move counters
    var mapScale = parseInt(fieldMap.attr('data-scale'));
    allowedMoves = 0;
    allowedMoves += mapScale + (mapScale - 1);
    allowedMoves += mechasDefeated * mechaMovesValue;
    allowedMoves += robotsDefeated * robotMovesValue;
    allowedMoves += bossesDefeated * bossMovesValue;

    // Update remaining moves counter and span
    remainingMoves = allowedMoves - usedMoves;
    fieldMovesRemaining.html(remainingMoves);
    console.log('remainingMoves = ', remainingMoves);

    // Recalculate point counters
    currentPoints = 0;
    currentPoints += mechasDefeated * mechaPointsValue;
    currentPoints += robotsDefeated * robotPointsValue;
    currentPoints += bossesDefeated * bossPointsValue;
    fieldPointsCurrent.html(currentPoints);
    console.log('currentPoints = ', currentPoints);

    // Recalculate complete percentage
    var targetsTotal = mechasTotal + robotsTotal + bossesTotal;
    var targetsDefeated = mechasDefeated + robotsDefeated + bossesDefeated;
    completePercent = Math.round(((targetsDefeated / targetsTotal) * 100), 2);
    fieldCompletePercent.html(completePercent + '%');
    console.log('currentPoints = ', completePercent);

}

// Define a function for updating game status
function updateGameStatus(){
    console.log('updateGameStatus()');


    // If the player has defeated all bosses, the game is complete
    if (bossesDefeated >= bossesTotal){
        console.log('bossesDefeated = ', bossesDefeated);
        console.log('bossesTotal = ', bossesTotal);
        fieldMap.addClass('complete success');
        fieldCounters.addClass('complete success');
    }
    // Else if the user is out of moves, the game is complete
    else if (remainingMoves == 0){
        console.log('remainingMoves = ', remainingMoves);
        fieldMap.addClass('complete failure');
        fieldCounters.addClass('complete failure');
    }

}