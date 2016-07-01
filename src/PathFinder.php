<?php

/**
 * Class PathFinder
 */
class PathFinder
{
    /**
     * @var Map
     */
    private $map;

    /**
     * Depends on the Map object
     *
     * @param Map $map
     */
    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    /**
     * Search for path between two checkpoints and draw the straight lines
     *
     * @param $start_row int Row number where the initial checkpoint is
     * @param $end_row int Row number where the end checkpoint is
     * @param $start_col int Column where the initial checkpoint is
     * @param $end_col int Column number where the end checkpoint is
     */
    private function drawLine($start_row, $end_row, $start_col, $end_col)
    {
        // if checkpoints on the same row
        if ($start_row == $end_row) {
            // direction of the line
            if ($end_col < $start_col) {
                for ($i = $start_col - 1; $i > $end_col; $i--) {
                    $this->map->makePath($start_row, $i);
                }
            } else {
                for ($i = $start_col + 1; $i < $end_col; $i++) {
                    $this->map->makePath($start_row, $i);
                }
            }
        } // if checkpoints on the diferent rows
        else {
            // draw vertical line
            for ($i = $start_row + 1; $i <= $end_row; $i++) {
                $this->map->makePath($i, $start_col);

            }
            // if checkpoints on the different columns, repeat the proccess
            if ($end_col != $start_col) {
                $this->drawLine($end_row, $end_row, $start_col, $end_col);
            }
        }
    }

    /**
     * Look for path between all of the checkpoint coordinates
     *
     * @return Map
     */
    public function drawPath()
    {
        $coordinates = $this->map->getCheckpointCoordinates();
        foreach ($coordinates as $key => $coord) {
            if (!isset($coordinates[$key + 1])) {
                break;
            }
            $start_row = key($coord);
            $end_row = key($coordinates[$key + 1]);

            $start_col = $coord[$start_row];
            $end_col = $coordinates[$key + 1][$end_row];
            $this->drawLine($start_row, $end_row, $start_col, $end_col);

        }

        return $this->map;
    }
}