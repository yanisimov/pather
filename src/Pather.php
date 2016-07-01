<?php

/**
 * Class Pather
 */
class Pather
{
    /**
     * @var Input file path
     */
    private $input;
    /**
     * @var Output file path
     */
    private $output;

    public function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * Converts file content to array
     *
     * @return array
     */
    public function fileToArray()
    {
        $map = file($this->input);
        foreach ($map as $key => $value) {
            $map[$key] = str_split($map[$key]);
        }

        return $map;
    }

    /**
     * Prints the result map to file as a string
     *
     * @param Map $map
     * @return int
     */
    public function output(Map $map)
    {
        $string = '';
        foreach ($map->getMap() as $row) {
            $string .= implode('', $row);
        }

        return file_put_contents($this->output, $string);
    }
}