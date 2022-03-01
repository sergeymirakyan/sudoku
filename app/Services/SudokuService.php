<?php


namespace App\Services;


use function Symfony\Component\HttpKernel\DataCollector\doDump;

/**
 * Class SudokuService
 * @package App\Services
 */
class SudokuService
{
    /**
     * @param array $sudoku
     * @return bool
     */
    public function validate(array $sudoku)
    {
        $rows = [[], [], [], [], [], [], [], [], []];
        $columns = [[], [], [], [], [], [], [], [], []];
        $boxes = [[], [], [], [], [], [], [], [], []];
        for ($i = 0; $i < count($sudoku); $i++) {
            for ($j = 0; $j < count($sudoku); $j++) {
                $cell = $sudoku[$i][$j];
                if ($cell < 0 || $cell > 9) {
                    return false;
                }
                //validate row, and if it is not in array push it
                if (in_array($cell, $rows[$i])) {
                    return false;
                } else {
                    $rows[$i][] = $cell;
                }
                //validate columns, and if it is not in array push it
                if (in_array($cell, $columns[$j])) {
                    return false;
                } else {
                    $columns[$j][] = $cell;
                }
                //validate boxes, and if it is not in array push it
                $boxIndex = floor(($i / 3)) * 3 + floor($j / 3);
                if(in_array($cell, $boxes[$boxIndex])) {
                    return false;
                } else {
                    $boxes[$boxIndex][] = $cell;
                }
            }
        }
        return true;
    }
}
