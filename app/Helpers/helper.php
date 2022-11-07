<?php


if (! function_exists('returnExceptions')) {
    function returnExceptions($e)
    { 
        $logFile = fopen("log_failed.txt", 'a') or die("Error creando archivo");

        fwrite(
            $logFile, 
            "\n\n" . date("d/m/Y H:i:s") . 
            "\n"   . "message => " . $e->getMessage() .
            "\n"   . "file => " . $e->getFile() .
            "\n"   . "line => " . $e->getLine() 
        ) or die("Error escribiendo en el archivo");
        
        fclose($logFile);

        return response()->json([
            "message" => $e->getMessage()
        ], 500);
    }
}

