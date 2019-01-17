<?php

/**
 * @param $int1
 * @param $int2
 * @return string
 */
function sumBigIntegers($int1, $int2) {
    $int1 = strrev(strval($int1));
    $int2 = strrev(strval($int2));
    $result = '';
    $int64MaxDigits = strlen((string)PHP_INT_MAX) - 1;

    if(strlen($int1) > strlen($int2)) {
        $bigger = $int1;
        $lower = $int2;
    } else {
        $bigger = $int1;
        $lower = $int2;
    }

    $part = 0;
    $inMemory = 0;
    while($lowerChunkResult = substr($lower, $part * $int64MaxDigits, $int64MaxDigits)) {
        $lowerChunkResult = intval(strrev($lowerChunkResult));
        $biggerChunkResult = intval(strrev(substr($bigger, $part * $int64MaxDigits, $int64MaxDigits)));
        $chunkSum = $lowerChunkResult + $biggerChunkResult;
        if($inMemory > 0)
            $chunkSum += $inMemory;
        $chunkSumString = (string)$chunkSum;
        if(strlen($chunkSumString) > $int64MaxDigits) {
            $inMemory = (int)$chunkSumString[0];
            $chunkSumString = substr($chunkSumString,1);
        } else {
            $inMemory = 0;
        }
        $result = $chunkSumString . $result;
        $part++;
    }

    while ($biggerChunkResult = intval(strrev(substr($bigger, $part * $int64MaxDigits, $int64MaxDigits)))) {
        if($inMemory > 0)
            $biggerChunkResult += $inMemory;
        $chunkSumString = string($biggerChunkResult);
        if(strlen($chunkSumString) > $int64MaxDigits) {
            $inMemory = (int)$chunkSumString[0];
            $chunkSumString = substr($chunkSumString, 1);
        } else {
            $inMemory = 0;
        }
        $result = $chunkSumString . $result;
        $part++;
    }

    return $result;
}

