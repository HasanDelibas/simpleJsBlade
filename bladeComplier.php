<pre><?php
class bladeComplier{

    public static function complie($bladeLocation,$outLocation,$name="Name"){

        $blade = file_get_contents($bladeLocation);

        $from =[
            "/\{\{\s*@foreach\(\s*([A-Za-z0-9\.\[\]\"\']+)\s* as \s*([A-Za-z0-9\.\[\]\"\']+)\s*\)\s*\}\}/",
            "/\{\{[^\}]*\@begin\s*\}\}/",
            "/\{\{\s*\@end\s*\}\}/",
            "/\{\{([^\}]+)\}\}/"
        ];

        $to = [
            "`;\n for(var i=0,$2=$1[Object.keys($1)[i]]; i < Object.keys($1).length ; i++ )",
            " { retVal+=`",
            " `; } retVal +=`",
            "`;\n retVal += $1 ;\n retVal +=`"
            ];
            
        

        $newBlade = preg_replace($from,$to,$blade);
        $newBlade = "$name = function(data){\nvar retVal =`".$newBlade."`;\nreturn retVal;}";
        print_r(str_replace(["<",">"],["&lt;","&gt;"], $newBlade));
        file_put_contents( $outLocation , $newBlade );

    }

    
}

?>
