<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SquareGridController extends Controller
{
    // Function to return the initial grid state
    public function getInitialState()
    {
        // Define the grid with random colors for each square (red or blue)
        $grid = [];
        $colors = ['red', 'blue'];

        // Generate a 3x3 grid with random colors
        for ($i = 0; $i < 3; $i++) {
            $row = [];
            for ($j = 0; $j < 3; $j++) {
                $row[] = $colors[array_rand($colors)];
            }
            $grid[] = $row;
        }

        // Return the grid in the required JSON format
        return response()->json(['grid' => $grid]);
    }

    // Function to update the grid based on the clicked square's position
    public function updateState(Request $request)
    {
        $validated = $request->validate([
            'row' => 'required|integer|between:0,2',
            'col' => 'required|integer|between:0,2',
            'newGrid' => 'required|array|min:3|max:3',
            'newGrid.*' => 'array|min:3|max:3',  // Ensures each row is an array of 3 items
            'newGrid.*.*' => 'in:red,blue',  // Ensures values are either red or blue
        ]);

        // Get the new grid and position
        $row = $validated['row'];
        $col = $validated['col'];
        $newGrid = $validated['newGrid'];

        // Determine the color of the clicked square
        $currentColor = $newGrid[$row][$col];

        // Function to toggle neighboring squares (up/down/left/right)
        $neighbors = [
            [-1, 0], [1, 0], [0, -1], [0, 1]  // Up, Down, Left, Right
        ];

        // Logic for the square that was clicked
        if ($currentColor === 'blue') {
            // If the clicked square is blue, turn all red squares in neighbors to blue
            foreach ($neighbors as $neighbor) {
                $newRow = $row + $neighbor[0];
                $newCol = $col + $neighbor[1];

                // Ensure neighbor is within bounds and is red
                if ($newRow >= 0 && $newRow < 3 && $newCol >= 0 && $newCol < 3 && $newGrid[$newRow][$newCol] === 'red') {
                    // Change red to blue
                    $newGrid[$newRow][$newCol] = 'blue';
                }
            }
        } elseif ($currentColor === 'red') {
            // If the clicked square is red, turn all blue squares in neighbors to red
            foreach ($neighbors as $neighbor) {
                $newRow = $row + $neighbor[0];
                $newCol = $col + $neighbor[1];

                // Ensure neighbor is within bounds and is blue
                if ($newRow >= 0 && $newRow < 3 && $newCol >= 0 && $newCol < 3 && $newGrid[$newRow][$newCol] === 'blue') {
                    // Change blue to red
                    $newGrid[$newRow][$newCol] = 'red';
                }
            }
        }

        // Toggle the clicked square itself (it should switch to the opposite color)
        $newGrid[$row][$col] = $currentColor === 'red' ? 'blue' : 'red';

        // Return the updated grid
        return response()->json([
            'row' => $row,
            'col' => $col,
            'newGrid' => $newGrid
        ]);
    }
}
