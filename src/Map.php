<?php

/**
 * Class Map
 */
class Map
{
    const CHECKPOINT_SYMBOL = '#';
    const PATH_SYMBOL = '*';

    /**
     * @var array Map as array
     */
    private $map;
    /**
     * @var array Checkpoint coordinates
     */
    private $coords;

    public function __construct($mapString)
    {
        $this->map = $mapString;
        $this->coords = $this->findCoords();
    }

    /**
     * Looking for checkpoints on the map
     *
     * @return array
     */
    private function findCoords()
    {
        $cords = [];
        foreach ($this->map as $row_num => $row) {
            foreach ($row as $col_num => $col) {
                if ($col == Map::CHECKPOINT_SYMBOL) {
                    $cords[] = [$row_num => $col_num];
                }
            }
        }

        return $cords;
    }

    /**
     * Returns map as array
     *
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Returns checkpoint coordinates
     *
     * @return array
     */
    public function getCheckpointCoordinates()
    {
        return $this->coords;
    }

    /**
     * Replaces the value of element by its coordinates
     *
     * @param $row
     * @param $col
     */
    public function makePath($row, $col)
    {
        $this->map[$row][$col] = Map::PATH_SYMBOL;
    }
}