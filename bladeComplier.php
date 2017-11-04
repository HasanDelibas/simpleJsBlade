<pre><?php
class bladeComplier{

    public static function complie($bladeLocation,$outLocation,$name="Name"){

        $blade = file_get_contents($bladeLocation);

        $script= "";
        
        $blade = preg_replace("/\n|\t| +/"," ",$blade);
        
        $scriptCount = preg_match_all("/\{\{\s*\@script\s*\}\}/",$blade);
        if( $scriptCount == 1 ){
            preg_match("/\{\{\s*\@script\s*\}\}(?<scripts>.*)\{\{\s*\@scriptend\s*\}\}/",$blade,$script);
            $script = $script['scripts'];
            $blade = preg_replace("/\{\{\s*\@script\s*\}\}(.*)\{\{\s*\@scriptend\s*\}\}/","",$blade);
            
        }elseif( $scriptCount==0 ){
            
            
        }else{
            echo "@script tag count can't more one.";
            return;
        }
        
        $from =[
            "/\{\{\s*@foreach\(\s*([A-Za-z0-9\.\[\]\"\']+)\s* as \s*([A-Za-z0-9\.\[\]\"\']+)\s*\)\s*\}\}/",
            "/\{\{\\s*@if\(([^\}]+)\)\s*\}\}/",
            "/\{\{\s*\@else\s*\}\}/",
            "/\{\{\s*\@begin\s*\}\}/",
            "/\{\{\s*\@end\s*\}\}/",
            "/\{\{([^\}]+)\}\}/"
        ];

        $to = [
            "`;for(var i=0,$2=$1[Object.keys($1)[i]]; i < Object.keys($1).length ; i++ )",
            "`;if ( $1 ){retVal+=`",
            "`;}else{retVal+=`",
            " {retVal+=`",
            " `;}retVal +=`",
            "`;retVal+=$1;retVal +=`"
            ];
            
        

        $newBlade = preg_replace($from,$to,$blade);
        
        //$newBlade = preg_replace("/\n/","",$newBlade);

        //$newBlade = str_replace(["&lt;","&gt;"],["<",">"], $newBlade);
        $newBlade = "$name=function(data){var retVal=`".$newBlade."`;return retVal;};".$script.";";
        
        file_put_contents( $outLocation , $newBlade );
        return $newBlade;
    }

    
}

?>
